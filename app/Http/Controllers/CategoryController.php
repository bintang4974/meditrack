<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Daftar Kategori";
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories', 'pageTitle'));
    }

    public function subCategories(Category $category)
    {
        return response()->json(
            $category->subCategories()->where('is_active', true)->get()
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Tambah Kategori";
        return view('categories.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_key'  => 'required|string|max:255',
            'category_main' => 'required|string|max:255',
            'category_sub'  => 'required|string|max:255',
            'category_sub_description' => 'nullable|string',
        ]);

        Category::create([
            'project_key' => $request->project_key,
            'category_key' => strtoupper(Str::random(10)),
            'category_main' => $request->category_main,
            'category_sub' => $request->category_sub,
            'category_sub_description' => $request->category_sub_description,
            'category_is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
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
    public function edit(Category $category)
    {
        $pageTitle = "Edit Kategori";
        return view('categories.edit', compact('category', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'project_key'  => 'required|string|max:255',
            'category_main' => 'required|string|max:255',
            'category_sub'  => 'required|string|max:255',
            'category_sub_description' => 'nullable|string',
            'category_is_active' => 'required|boolean',
        ]);

        $category->update([
            'project_key' => $request->project_key,
            'category_main' => $request->category_main,
            'category_sub' => $request->category_sub,
            'category_sub_description' => $request->category_sub_description,
            'category_is_active' => $request->category_is_active,
            'category_status_updated_at' => now(),
            'category_deactivation_note' => $request->category_deactivation_note,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
