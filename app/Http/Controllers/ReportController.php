<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index(Project $project)
    {
        $pageTitle = "Laporan Bulanan";
        $years = Entry::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
        return view('reports.index', compact('project', 'years', 'pageTitle'));
    }

    public function exportExcel(Project $project, Request $request)
    {
        $month = (int) $request->input('month'); // pastikan jadi angka
        $year = (int) $request->input('year');

        $entries = Entry::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('project_id', $project->id)
            ->with(['patient.site'])
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Laporan Portofolio Bulanan');
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A2', "Periode: " . Carbon::create()->month($month)->locale('id')->monthName . " $year");
        $sheet->mergeCells('A2:F2');

        // Table Header
        $sheet->fromArray(['No', 'Tanggal', 'Nama Pasien', 'Rumah Sakit', 'Deskripsi', 'Tingkat Objektif'], NULL, 'A4');

        $row = 5;
        foreach ($entries as $index => $entry) {
            $sheet->fromArray([
                $index + 1,
                $entry->created_at->format('d-m-Y'),
                $entry->patient->name ?? '-',
                $entry->patient->site->name ?? '-',
                $entry->description ?? '-',
                $entry->competence_level ?? '-'
            ], NULL, "A{$row}");
            $row++;
        }

        $sheet->setTitle("Laporan $month-$year");
        $writer = new Xlsx($spreadsheet);

        $fileName = "Laporan_{$project->name}_{$month}_{$year}.xlsx";
        $filePath = storage_path("app/public/$fileName");
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPdf(Project $project, Request $request)
    {
        $month = (int) $request->input('month'); // pastikan jadi angka
        $year = (int) $request->input('year');

        $entries = Entry::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('project_id', $project->id)
            ->with(['patient.site'])
            ->get();

        $pdf = Pdf::loadView('reports.pdf', compact('entries', 'project', 'month', 'year'));
        return $pdf->download("Laporan_{$project->name}_{$month}_{$year}.pdf");
    }
}
