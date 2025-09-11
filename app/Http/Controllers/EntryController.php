<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
use App\Models\Project;
use Illuminate\Http\Request;
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
        // $projectId = $request->get('project');
        return view('entry.create', compact('categories', 'project', 'pageTitle'));
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
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'entry_date' => 'nullable|date',
            'entry_time' => 'nullable',
            'entry_description' => 'nullable|string',

            // contoh validasi surgical
            'surgical_date_id' => 'nullable|date',
            'surgical_site_key' => 'nullable|string',
            'surgery_start_time' => 'nullable',
            'surgery_end_time' => 'nullable',
            'preoperative_diagnosis' => 'nullable|string',
            'intraoperative_diagnosis' => 'nullable|string',
            'surgical_procedure' => 'nullable|string',
            'estimated_blood_loss' => 'nullable|integer',
            'surgical_notes' => 'nullable|string',

            // waitlist
            'waitlist_status' => 'nullable|string',
            'waitlist_communication_log' => 'nullable|string',
            'waitlist_entry_date' => 'nullable|date',
            'waitlist_group' => 'nullable|string',
            'waitlist_type' => 'nullable|string',
            'waitlist_planned_procedure' => 'nullable|string',
            'waitlist_scheduling_status' => 'nullable|string',
            'waitlist_completed_date' => 'nullable|date',
            'waitlist_completion_reason' => 'nullable|string',
            'waitlist_completion_notes' => 'nullable|string',
            'waitlist_suspended_date' => 'nullable|date',
            'waitlist_suspended_reason' => 'nullable|string',
            'waitlist_suspended_notes' => 'nullable|string',

            'entry_supervisor' => 'nullable|integer',
            'competence_level' => 'nullable|string',
            'insurance_status' => 'nullable|string',
            'insurance_notes' => 'nullable|string',
        ]);

        // file upload
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('entries/images', 'public');
            }
            $data['log_image_files'] = json_encode($paths);
        }

        if ($request->hasFile('documents')) {
            $paths = [];
            foreach ($request->file('documents') as $file) {
                $paths[] = $file->store('entries/docs', 'public');
            }
            $data['log_document_files'] = json_encode($paths);
        }

        // simpan entry
        Entry::create(array_merge($data, [
            'project_id' => $project->id,
            'entry_key'  => uniqid('ENTRY'),
            'created_by' => Auth::id(),
        ]));

        return redirect()->route('projects.show', $project->id)->with('success', 'Entry berhasil dibuat');
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
