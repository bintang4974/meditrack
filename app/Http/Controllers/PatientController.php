<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Site;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Daftar Pasien";
        $patients = Patient::with('site')->latest()->get();

        return view('patients.index', compact('patients', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Tambah Pasien";
        $sites = Site::all(); // pilih site (RS)
        return view('patients.create', compact('pageTitle', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|exists:sites,id',
            'rekam_medis' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $pageTitle = "Edit Pasien";
        $sites = Site::all();
        return view('patients.edit', compact('patient', 'sites', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'site_id' => 'required|exists:sites,id',
            'rekam_medis' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus!');
    }
}
