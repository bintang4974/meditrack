<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $pageTitle = "Daftar Rumah Sakit";
        $sites = $project->sites;

        return view('sites.index', compact('project', 'sites', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $pageTitle = "Tambah Rumah Sakit";
        return view('sites.create', compact('project', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'location'          => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'institution'       => 'nullable|string|max:255',
            'site_type'         => 'required|in:Hospital,Clinic,Private Practice,Diagnostic Center,Medical School,Other',
            'coordinates'       => 'nullable|string|max:100',
            'status'            => 'required|in:active,inactive',
            'deactivation_note' => 'nullable|string',
        ]);

        $project->sites()->create([
            'name'              => $request->name,
            'location'          => $request->location,
            'description'       => $request->description,
            'institution'       => $request->institution,
            'site_type'         => $request->site_type,
            'coordinates'       => $request->coordinates,
            'status'            => $request->status,
            'status_updated_at' => now(),
            'deactivation_note' => $request->status === 'inactive' ? $request->deactivation_note : null,
            'created_by'        => auth()->id(),
            'last_modified_by'  => auth()->id(),
        ]);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Site $site)
    {
        $pageTitle = "Detail Pasien Rumah Sakit";
        $site->load('patients');
        return view('sites.show', compact('project', 'site', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Site $site)
    {
        $pageTitle = "Edit Rumah Sakit";
        return view('sites.edit', compact('project', 'site', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Site $site)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'institution' => 'nullable|string|max:255',
            'site_type' => 'required|in:Hospital,Clinic,Private Practice,Diagnostic Center,Medical School,Other',
            'coordinates' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'deactivation_note' => 'nullable|string',
        ]);

        $site->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'institution' => $request->institution,
            'site_type' => $request->site_type,
            'coordinates' => $request->coordinates,
            'status' => $request->status,
            'status_updated_at' => now(),
            'deactivation_note' => $request->status === 'inactive' ? $request->deactivation_note : null,
            'last_modified_by' => auth()->id(),
        ]);

        return redirect()->route('sites.index', $project->id)->with('success', 'Data rumah sakit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Site $site)
    {
        $site->delete();

        return redirect()->route('sites.index', $project->id)->with('success', 'Rumah sakit berhasil dihapus.');
    }
}
