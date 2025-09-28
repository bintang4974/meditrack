<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Project;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $pageTitle = "Daftar Dokter";
        $doctors = Doctor::whereHas('sites', function ($q) use ($project) {
            $q->where('project_id', $project->id);
        })->get();

        return view('doctors.index', compact('project', 'doctors', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $pageTitle = "Tambah Dokter";
        $sites = $project->sites;

        return view('doctors.create', compact('project', 'sites', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // dd($project->id, $request->all());
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'role'  => 'required|in:doctor,supervisor',
            'specialty' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'sites' => 'required|array|min:1',
            'sites.*' => 'exists:sites,id'
        ]);

        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'specialty' => $request->specialty,
            'notes' => $request->notes,
            'status' => 'active',
            'status_updated_at' => now(),
            'created_by' => Auth::id(),
            'last_modified_by' => Auth::id(),
        ]);

        // attach sites dengan pivot tambahan default
        $syncData = [];
        foreach ($request->sites as $siteId) {
            $syncData[$siteId] = [
                'status' => 'active',
                'status_updated_at' => now(),
                'deactivation_note' => null,
            ];
        }

        $doctor->sites()->sync($syncData);

        return redirect()->route('doctors.index', $project->id)
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Doctor $doctor)
    {
        $pageTitle = "Edit Dokter";
        $sites = $project->sites;

        return view('doctors.edit', compact('project', 'doctor', 'sites', 'pageTitle'));
    }

    public function update(Request $request, Project $project, Doctor $doctor)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'role'  => 'required|in:doctor,supervisor',
            'specialty' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'sites' => 'required|array',
            'sites.*' => 'exists:sites,id'
        ]);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'specialty' => $request->specialty,
            'notes' => $request->notes,
            'last_modified_by' => Auth::id(),
        ]);

        $syncData = [];
        foreach ($request->sites as $siteId) {
            $syncData[$siteId] = [
                'status' => 'active',
                'status_updated_at' => now(),
                'deactivation_note' => null,
            ];
        }

        $doctor->sites()->sync($syncData);

        return redirect()->route('doctors.index', $project->id)
            ->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy(Project $project, Doctor $doctor)
    {
        $doctor->sites()->detach();
        $doctor->delete();

        return redirect()->route('doctors.index', $project->id)
            ->with('success', 'Dokter berhasil dihapus.');
    }
}
