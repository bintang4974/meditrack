<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
use App\Models\Patient;
use App\Models\Project;
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
        $pageTitle = 'Entry';
        $entries = Entry::with('category')->latest()->get();
        return view('entry.index', compact('entries', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $pageTitle = 'Create Entry';
        $categories = Category::all();
        // ambil semua pasien dari site dalam project ini
        $patients = Patient::whereIn('site_id', $project->sites->pluck('id'))->get();
        // $projectId = $request->get('project');
        return view('entry.create', compact('categories', 'project', 'pageTitle', 'patients'));
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
    public function store(Request $request, Project $project)
    {
        // Buat unique key
        $entryKey = 'ENT-' . strtoupper(Str::random(8));

        // Simpan entry
        $entry = new Entry();
        $entry->project_id = $project->id;
        $entry->patient_id = $request->patient_id;
        $entry->entry_key = $entryKey;
        $entry->encounter_key = $request->encounter_key; // optional
        $entry->category_id = $request->category_id;

        // ---------------- Surgical Care ----------------
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

        // ---------------- Waitlist ----------------
        $entry->waitlist_status = $request->waitlist_status;
        $entry->waitlist_communication_log = $request->waitlist_communication_log;
        $entry->waitlist_entry_date = $request->waitlist_entry_date;
        $entry->waitlist_group = $request->waitlist_group;
        $entry->waitlist_type = $request->waitlist_type;
        $entry->waitlist_duration = $request->waitlist_duration;
        $entry->waitlist_planned_procedure = $request->waitlist_planned_procedure;
        $entry->waitlist_operator_key = $request->waitlist_operator_key;
        $entry->waitlist_scheduling_status = $request->waitlist_scheduling_status;
        $entry->waitlist_scheduled_date = $request->waitlist_scheduled_date;
        $entry->waitlist_operating_room = $request->waitlist_operating_room;
        $entry->waitlist_surgery_round = $request->waitlist_surgery_round;
        $entry->waitlist_completed_date = $request->waitlist_completed_date;
        $entry->waitlist_completion_reason = $request->waitlist_completion_reason;
        $entry->waitlist_completion_notes = $request->waitlist_completion_notes;
        $entry->waitlist_duration_completed = $request->waitlist_duration_completed;
        $entry->waitlist_suspended_date = $request->waitlist_suspended_date;
        $entry->waitlist_suspended_reason = $request->waitlist_suspended_reason;
        $entry->waitlist_suspended_notes = $request->waitlist_suspended_notes;

        // ---------------- General ----------------
        $entry->entry_description = $request->entry_description;
        $entry->entry_label = $request->entry_label;
        $entry->entry_date = $request->entry_date;
        $entry->entry_time = $request->entry_time;

        // Handle upload file (gambar)
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/images', 'public');
                $images[] = $path;
            }
            $entry->log_image_files = json_encode($images);
        }

        // Handle upload file (dokumen)
        if ($request->hasFile('documents')) {
            $docs = [];
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/documents', 'public');
                $docs[] = $path;
            }
            $entry->log_document_files = json_encode($docs);
        }

        // ---------------- Supervisor & Competence ----------------
        $entry->entry_supervisor = $request->entry_supervisor;
        $entry->competence_level = $request->competence_level;

        // ---------------- Insurance ----------------
        $entry->insurance_status = $request->insurance_status;
        $entry->insurance_notes = $request->insurance_notes;

        // ---------------- Audit ----------------
        $entry->created_by = auth()->id();
        $entry->last_modified_by = auth()->id();

        $entry->save();

        return redirect()->route('entries.show', $entry->id)->with('success', 'Entry berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Show Entry';

        $entry = Entry::with([
            'category',
            'operator1',
            'operator2',
            'operator3',
            'operator4',
            'supervisor',
            'createdBy'
        ])->findOrFail($id);

        return view('entry.show', compact('entry', 'pageTitle'));
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
