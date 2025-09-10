<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
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
    public function create()
    {
        $pageTitle = 'Create Entry';
        $categories = Category::all();
        return view('entries.create', compact('categories', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'entry_description' => 'required|string',
            'entry_date' => 'required|date',
        ]);

        Entry::create([
            'project_key' => 'PRJAAA0001', // sementara hardcoded, nanti ambil dari project aktif
            'encounter_key' => 'ENC001', // sementara dummy
            'category_id' => $request->category_id,
            'entry_key' => uniqid('ENTRY'),
            'entry_description' => $request->entry_description,
            'entry_date' => $request->entry_date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('entries.index')->with('success', 'Entry berhasil ditambahkan');
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
