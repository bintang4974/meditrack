<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    // 🔹 Index per project
    public function index(Project $project, Request $request)
    {
        $status = $request->query('status', 'active'); // default aktif
        $query = Label::where('project_id', $project->id);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $labels = $query->orderBy('name')->get();

        return view('labels.index', compact('project', 'labels', 'status'));
    }

    // 🔹 Create form
    public function create(Project $project)
    {
        $pageTitle = "Tambah Label";
        return view('labels.create', compact('project', 'pageTitle'));
    }

    // 🔹 Store
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Label::create([
            'project_id' => $project->id,
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('labels.index', $project->id)
            ->with('success', 'Label berhasil ditambahkan.');
    }

    // 🔹 Show entries dalam label
    public function show(Project $project, Label $label)
    {
        if ($label->project_id !== $project->id) abort(403);
        $entries = $label->entries()->with('patient.site')->get();

        return view('labels.show', compact('project', 'label', 'entries'));
    }

    // 🔹 Edit form
    public function edit(Project $project, Label $label)
    {
        if ($label->project_id !== $project->id) abort(403);
        $pageTitle = "Edit Label";
        return view('labels.edit', compact('project', 'label', 'pageTitle'));
    }

    // 🔹 Update
    public function update(Request $request, Project $project, Label $label)
    {
        if ($label->project_id !== $project->id) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $label->update([
            'name' => $request->name,
            'description' => $request->description,
            'last_modified_by' => Auth::id(),
        ]);

        return redirect()->route('labels.index', $project->id)
            ->with('success', 'Label berhasil diperbarui.');
    }

    // 🔹 Toggle aktif/nonaktif
    public function toggleStatus(Project $project, Label $label)
    {
        if ($label->project_id !== $project->id) abort(403);

        $newStatus = $label->status === 'active' ? 'inactive' : 'active';
        $label->update([
            'status' => $newStatus,
            'status_updated_at' => now(),
            'last_modified_by' => Auth::id(),
        ]);

        return back()->with('success', "Label berhasil diubah menjadi {$newStatus}.");
    }

    // 🔹 Destroy
    public function destroy(Project $project, Label $label)
    {
        if ($label->project_id !== $project->id) abort(403);

        $label->delete();

        return back()->with('success', 'Label berhasil dihapus.');
    }

    // 🔹 Filter entries berdasarkan multi-label
    public function filter(Project $project, Request $request)
    {
        $labels = Label::where('project_id', $project->id)->where('status', 'active')->get();
        $selectedLabels = $request->input('labels', []);

        $entries = collect();

        if (!empty($selectedLabels)) {
            $entries = Entry::whereHas('labels', function ($q) use ($selectedLabels) {
                $q->whereIn('labels.id', $selectedLabels);
            }, '=', count($selectedLabels))
                ->with('patient.site')
                ->get();
        }

        return view('labels.filter', compact('project', 'labels', 'entries', 'selectedLabels'));
    }
}
