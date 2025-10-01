<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Project;
use App\Models\Site;
use App\Models\Tag;
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
        $tags = Tag::where('status', 'active')->get();

        return view('patients.create', compact('pageTitle', 'project', 'site', 'tags'));
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
            'age' => 'nullable|integer|min:0',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'working_assessment' => 'nullable|string',
            'context_summary' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $patient = Patient::create([
            'site_id' => $site->id,
            'rekam_medis' => $request->rekam_medis,
            'name' => $request->name,
            'dob' => $request->dob,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'working_assessment' => $request->working_assessment,
            'context_summary' => $request->context_summary,
            'created_by' => auth()->id(),
            'last_modified_by' => auth()->id(),
        ]);

        if ($request->filled('tags')) {
            $patient->tags()->attach($request->tags);
        }

        return redirect()->route('sites.show', [$project->id, $site->id])
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Site $site, Patient $patient)
    {
        // ambil entries untuk pasien ini
        $entries = $patient->entries()->with(['category', 'createdBy'])->get();

        return view('patients.show', [
            'pageTitle' => 'Detail Pasien',
            'project'   => $project,
            'site'      => $site,
            'patient'   => $patient,
            'entries'   => $entries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Site $site, Patient $patient)
    {
        $pageTitle = "Edit Pasien";
        $tags = Tag::where('status', 'active')->get();
        $selectedTags = $patient->tags->pluck('id')->toArray();

        return view('patients.edit', compact('pageTitle', 'project', 'site', 'patient', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Site $site, Patient $patient)
    {
        $request->validate([
            'rekam_medis' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer|min:0',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'working_assessment' => 'nullable|string',
            'context_summary' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $patient->update([
            'rekam_medis' => $request->rekam_medis,
            'name' => $request->name,
            'dob' => $request->dob,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'working_assessment' => $request->working_assessment,
            'context_summary' => $request->context_summary,
            'last_modified_by' => auth()->id(),
        ]);

        $patient->tags()->sync($request->tags ?? []);

        return redirect()->route('patients.show', [$project->id, $site->id, $patient->id])
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Site $site, Patient $patient)
    {
        $patient->delete();

        return redirect()->route('sites.show', [$project->id, $site->id])
            ->with('success', 'Pasien berhasil dihapus.');
    }
}
