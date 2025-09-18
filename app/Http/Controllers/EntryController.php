<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
use App\Models\Patient;
use App\Models\Project;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pageTitle = 'Entry';
        // $entries = Entry::with('category')->latest()->get();
        // return view('entry.index', compact('entries', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project, Site $site, Patient $patient)
    {
        $pageTitle = 'Tambah Entry';
        // $categories = Category::where('project_key', $project->project_code)->get();
        // $categories = Category::all();
        $categories = Category::with('subCategories')->get();

        return view('entry.create', compact('pageTitle', 'project', 'site', 'patient', 'categories'));
    }

    public function getSubCategories(Category $category)
    {
        // Ambil hanya sub categories yang aktif
        $subs = $category->subCategories()->where('is_active', true)->get(['id', 'name']);
        return response()->json($subs);
    }

    // load form fields sesuai kategori (AJAX)
    public function formFields($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('entry.forms.dynamic', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project, Site $site, Patient $patient)
    {
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'entry_date' => 'required|date',
            'entry_label' => 'nullable|string|max:255',
            'entry_description' => 'nullable|string',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $entry = new Entry();
        $entry->project_id = $project->id;
        $entry->patient_id = $patient->id;
        $entry->sub_category_id = $request->sub_category_id;
        $entry->entry_key = 'ENT' . strtoupper(uniqid());
        $entry->entry_date = now();
        $entry->created_by = auth()->id();

        // General
        $entry->entry_label = $request->entry_label;
        $entry->entry_description = $request->entry_description;
        $entry->entry_date = $request->entry_date;
        $entry->entry_time = $request->entry_time;

        // Surgical Care
        $entry->surgical_date_id = $request->surgical_date_id;
        $entry->surgical_site_key = $request->surgical_site_key;
        $entry->surgery_start_time = $request->surgery_start_time;
        $entry->surgery_end_time = $request->surgery_end_time;
        $entry->operator_1 = $request->operator_1;
        $entry->operator_2 = $request->operator_2;
        $entry->operator_3 = $request->operator_3;
        $entry->operator_4 = $request->operator_4;
        $entry->preoperative_diagnosis = $request->preoperative_diagnosis;
        $entry->intraoperative_diagnosis = $request->intraoperative_diagnosis;
        $entry->surgical_procedure = $request->surgical_procedure;
        $entry->estimated_blood_loss = $request->estimated_blood_loss;
        $entry->surgical_notes = $request->surgical_notes;

        // Waitlist
        $entry->waitlist_status = $request->waitlist_status;
        $entry->waitlist_entry_date = $request->waitlist_entry_date;
        $entry->waitlist_planned_procedure = $request->waitlist_planned_procedure;

        if ($request->hasFile('image_file')) {
            $entry->image_file = $request->file('image_file')->store('images', 'public');
        }
        if ($request->hasFile('document_file')) {
            $entry->document_file = $request->file('document_file')->store('documents', 'public');
        }


        // Supervisor & Competence
        $entry->entry_supervisor = $request->entry_supervisor;
        $entry->competence_level = $request->competence_level;

        // Insurance
        $entry->insurance_status = $request->insurance_status;
        $entry->insurance_notes = $request->insurance_notes;

        // Audit
        $entry->created_by = Auth::id();
        $entry->last_modified_by = Auth::id();

        $entry->save();

        return redirect()->route('patients.show', [$project->id, $site->id, $patient->id])
            ->with('success', 'Entry berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Site $site, Patient $patient, Entry $entry)
    {
        $pageTitle = "Detail Entry";

        if ($entry->patient_id !== $patient->id) {
            abort(404);
        }

        $entry->load(['category', 'createdBy', 'supervisor']);

        return view('entry.show', compact('pageTitle', 'project', 'site', 'patient', 'entry'));
    }

    // public function formFields($categoryId)
    // {
    //     $category = Category::findOrFail($categoryId);

    //     // passing category_main dan category_sub ke view
    //     return view('entry.forms.dynamic', compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
