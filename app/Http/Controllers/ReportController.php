<?php

namespace App\Http\Controllers;

use App\Models\{Project, Site, Category, SubCategory, Entry, Label, Tag};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $projects = Project::whereHas('users', fn($q) => $q->where('user_id', $user->id))
            ->orWhere('owner_id', $user->id)
            ->get();

        $firstProject = $projects->first();

        $sites = $firstProject
            ? $firstProject->sites()->where('status', 'active')->orderBy('name')->get()
            : collect(); // biar ga error kalau project kosong

        $categories = Category::with(['subCategories' => fn($q) => $q->where('is_active', true)])->get();
        $labels = Label::where('status', 'active')->get();
        $tags = Tag::where('status', 'active')->get();

        return view('reports.index', compact('projects', 'categories', 'labels', 'tags', 'sites'));
    }

    public function getSites(Project $project)
    {
        $sites = $project->sites()->where('status', 'active')->orderBy('name')->get(['id', 'name']);

        return response()->json($sites);
    }

    public function filter(Request $request)
    {
        $entries = $this->getFilteredEntries($request);

        return response()->json([
            'html' => view('reports._table', compact('entries'))->render(),
            'count' => $entries->count(),
        ]);
    }

    public function exportExcel(Request $request)
    {
        $entries = $this->getFilteredEntries($request);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Aktivitas');

        $sheet->fromArray([
            ['No', 'Tanggal', 'Pasien', 'Rumah Sakit', 'Kategori', 'Sub Kategori', 'Kompetensi', 'Label', 'Tag']
        ], null, 'A1');

        $row = 2;
        foreach ($entries as $index => $entry) {
            $sheet->fromArray([
                $index + 1,
                $entry->entry_date,
                $entry->patient->name ?? '-',
                $entry->patient->site->name ?? '-',
                $entry->subCategory->category->name ?? '-',
                $entry->subCategory->name ?? '-',
                $entry->competence_level ?? '-',
                $entry->labels->pluck('name')->join(', '),
                $entry->patient->tags->pluck('name')->join(', ')
            ], null, "A{$row}");
            $row++;
        }

        $fileName = 'Report_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path("app/public/{$fileName}");
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request)
    {
        $filters = json_decode($request->filters, true) ?? [];

        // normalize single-value arrays
        foreach (['site_id', 'project_id', 'scope', 'from_date', 'to_date'] as $key) {
            if (isset($filters[$key]) && is_array($filters[$key])) {
                $filters[$key] = $filters[$key][0];
            }
        }
        
        $request->merge($filters);

        $entries = $this->getFilteredEntries($request);
        $project = Project::find($request->project_id);

        $pdf = Pdf::loadView('reports.pdf', [
            'entries' => $entries,
            'project' => $project,
            'filters' => $filters,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Report_' . now()->format('Ymd_His') . '.pdf');
    }

    private function getFilteredEntries(Request $request)
    {
        $project = Project::find($request->project_id);

        return Entry::query()
            ->where('project_id', $project?->id)
            ->when($request->filled('site_id') && $request->site_id !== 'all', fn($q) => $q->whereHas('patient', fn($x) => $x->where('site_id', $request->site_id)))
            // ->when($request->filled('site_id'), fn($q) => $q->whereHas('patient', fn($x) => $x->where('site_id', $request->site_id)))
            ->when($request->filled('sub_category_ids'), fn($q) => $q->whereIn('sub_category_id', $request->sub_category_ids))
            ->when($request->filled('label_ids'), fn($q) => $q->whereHas('labels', fn($x) => $x->whereIn('labels.id', $request->label_ids)))
            ->when($request->filled('tag_ids'), fn($q) => $q->whereHas('patient.tags', fn($x) => $x->whereIn('tags.id', $request->tag_ids)))
            ->when($request->filled('from_date') && $request->filled('to_date'), fn($q) => $q->whereBetween('entry_date', [$request->from_date, $request->to_date]))
            ->when($request->input('scope') === 'mine', fn($q) => $q->where('created_by', Auth::id()))
            ->with(['patient.site', 'subCategory.category', 'labels', 'patient.tags'])
            ->get();
    }
}
