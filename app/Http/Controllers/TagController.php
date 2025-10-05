<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    // public function index()
    // {
    //     $tags = Tag::where('status', 'active')->get();
    //     return view('tags.index', compact('tags'));
    // }

    public function show(Project $project, Tag $tag)
    {
        // Pastikan tag ini milik project yang sama
        if ($tag->project_id !== $project->id) {
            abort(403, 'Tag tidak termasuk dalam project ini.');
        }

        $patients = $tag->patients()->with('site')->get();

        return view('tags.show', [
            'project' => $project,
            'tag' => $tag,
            'patients' => $patients,
        ]);
    }

    public function filter(Project $project, Request $request)
    {
        // Ambil semua tag aktif di project ini
        $tags = Tag::where('project_id', $project->id)
            ->where('status', 'active')
            ->get();

        $selectedTags = $request->input('tags', []);
        $patients = collect();

        if (!empty($selectedTags)) {
            // Ambil pasien di project yang memiliki SEMUA tag yang dipilih
            $patients = Patient::whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('tags.id', $selectedTags);
            }, '=', count($selectedTags))
                ->whereHas('site', function ($q) use ($project) {
                    $q->where('project_id', $project->id);
                })
                ->with('site')
                ->get();
        }

        return view('tags.filter', compact('project', 'tags', 'patients', 'selectedTags'));
    }

    // List Tags per Project
    public function index(Project $project)
    {
        $pageTitle = "Daftar Tags";
        $tags = Tag::where('project_id', $project->id)
            ->orderByRaw("FIELD(status, 'active', 'inactive')")
            ->get();
        $isOwner = $project->owner_id === Auth::id();

        return view('tags.index', compact('pageTitle', 'project', 'tags', 'isOwner'));
    }

    // Form Tambah Tag
    public function create(Project $project)
    {
        $this->authorizeOwner($project);
        $pageTitle = "Tambah Tag";
        return view('tags.create', compact('pageTitle', 'project'));
    }

    // Simpan Tag
    public function store(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Tag::create([
            'project_id' => $project->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'status' => 'active',
            'created_by' => Auth::id(),
            'last_modified_by' => Auth::id(),
        ]);

        return redirect()->route('tags.index', $project->id)
            ->with('success', 'Tag berhasil ditambahkan.');
    }

    // Edit Form
    public function edit(Project $project, Tag $tag)
    {
        $this->authorizeOwner($project);
        $pageTitle = "Edit Tag";

        if ($tag->project_id !== $project->id) {
            abort(403);
        }

        return view('tags.edit', compact('pageTitle', 'project', 'tag'));
    }

    // Update Data
    public function update(Request $request, Project $project, Tag $tag)
    {
        $this->authorizeOwner($project);

        if ($tag->project_id !== $project->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $tag->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'last_modified_by' => Auth::id(),
        ]);

        return redirect()->route('tags.index', $project->id)
            ->with('success', 'Tag berhasil diperbarui.');
    }

    // Delete
    public function destroy(Project $project, Tag $tag)
    {
        $this->authorizeOwner($project);

        if ($tag->project_id !== $project->id) {
            abort(403);
        }

        $tag->delete();

        return back()->with('success', 'Tag berhasil dihapus.');
    }

    // Toggle Active/Inactive
    public function toggleStatus(Project $project, Tag $tag)
    {
        $this->authorizeOwner($project);

        if ($tag->project_id !== $project->id) {
            abort(403);
        }

        $newStatus = $tag->status === 'active' ? 'inactive' : 'active';
        $tag->update([
            'status' => $newStatus,
            'status_updated_at' => now(),
            'last_modified_by' => Auth::id(),
        ]);

        return back()->with('success', "Tag berhasil diubah menjadi {$newStatus}.");
    }

    private function authorizeOwner(Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengelola tags pada project ini.');
        }
    }
}
