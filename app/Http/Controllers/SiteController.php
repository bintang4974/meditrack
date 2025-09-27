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
            'name' => 'required|string',
            'location' => 'nullable|string',
        ]);

        $site = $project->sites()->create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Rumah sakit berhasil ditambahkan.');
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
    public function edit(Site $site)
    {
        // $pageTitle = "Edit Rumah Sakit";
        // return view('sites.edit', compact('site', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        // $request->validate([
        //     'name'     => 'required|string|max:255',
        //     'location' => 'nullable|string|max:255',
        // ]);

        // $site->update($request->only('name', 'location'));

        // return redirect()->route('sites.index')->with('success', 'Rumah sakit berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        // $site->delete();
        // return redirect()->route('sites.index')->with('success', 'Rumah sakit berhasil dihapus!');
    }
}
