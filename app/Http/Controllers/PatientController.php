<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Project;
use App\Models\Site;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pageTitle = "Daftar Pasien";
        // $patients = Patient::with('site')->latest()->get();

        // return view('patients.index', compact('patients', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project, Site $site)
    {
        $pageTitle = "Tambah Pasien";
        return view('patients.create', compact('pageTitle', 'project', 'site'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project, Site $site)
    {
        $request->validate([
            'rekam_medis' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
        ]);

        Patient::create([
            'site_id' => $site->id,
            'rekam_medis' => $request->rekam_medis,
            'name' => $request->name,
            'dob' => $request->dob,
        ]);

        return redirect()->route('sites.show', [$project->id, $site->id])
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Site $site, Patient $patient)
    {
        $pageTitle = "Detail Pasien";
        // Pastikan pasien belong to site
        if ($patient->site_id !== $site->id) {
            abort(404);
        }

        // Load entries pasien
        $entries = $patient->entries()->with(['category', 'createdBy'])->latest()->get();

        return view('patients.show', compact('pageTitle', 'project', 'site', 'patient', 'entries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        // $pageTitle = "Edit Pasien";
        // $sites = Site::all();
        // return view('patients.edit', compact('patient', 'sites', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        // $request->validate([
        //     'site_id' => 'required|exists:sites,id',
        //     'rekam_medis' => 'required|string|max:255',
        //     'name' => 'nullable|string|max:255',
        //     'dob' => 'nullable|date',
        // ]);

        // $patient->update($request->all());

        // return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        // $patient->delete();
        // return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus!');
    }
}
