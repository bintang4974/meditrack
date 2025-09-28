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
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
        $categories = Category::with('subCategories')->get();

        // Dokter aktif di rumah sakit ini
        $doctors = $site->doctors()
            ->where('doctors.status', 'active')
            ->wherePivot('status', 'active')   // cek pivot juga
            ->get();
        // $doctors = $site->doctors()
        //     ->where('doctors.status', 'active') // prefix tabel doctors
        //     ->get();

        // Supervisor aktif saja
        $supervisors = $site->doctors()
            ->where('doctors.status', 'active')
            ->where('doctors.role', 'supervisor')
            ->wherePivot('status', 'active')   // cek pivot juga
            ->get();
        // $supervisors = $site->doctors()
        //     ->where('doctors.status', 'active') // prefix tabel doctors
        //     ->where('doctors.role', 'supervisor')
        //     ->get();

        return view('entry.create', compact('pageTitle', 'project', 'site', 'patient', 'categories', 'doctors', 'supervisors'));
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
        // Ambil semua kolom dari tabel entries
        $columns = Schema::getColumnListing('entries');

        // Generate entry_key jika belum ada
        $entryKey = $request->entry_key ?? 'ENT-' . strtoupper(Str::random(8));

        // Filter request hanya untuk kolom yang ada di tabel
        $data = $request->only($columns);

        // Set kolom wajib
        $data['project_id'] = $project->id;
        $data['patient_id'] = $patient->id;
        $data['entry_key'] = $entryKey;
        $data['created_by'] = auth()->id();
        $data['last_modified_by'] = auth()->id();

        // Buat instance ImageManager
        $manager = new ImageManager(new Driver());

        // Handle upload gambar
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $filename = 'entries/images/' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize / compress gambar (max width 1200px, kualitas 80%)
            $resized = $manager->read($image->getRealPath())
                ->scale(width: 1200)   // resize ke max 1200px, height auto
                ->toJpeg(80);          // compress ke JPEG dengan kualitas 80%

            // Simpan ke storage
            Storage::disk('public')->put($filename, (string) $resized);
            $data['image_file'] = $filename;
        }

        // Handle upload dokumen
        if ($request->hasFile('document_file')) {
            $doc = $request->file('document_file');
            $filename = $doc->store('entries/documents', 'public');
            $data['document_file'] = $filename;
        }

        // Simpan ke database
        $entry = Entry::create($data);

        return redirect()
            ->route('patients.show', [$project->id, $site->id, $patient->id])
            ->with('success', 'Entry berhasil ditambahkan.');
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
