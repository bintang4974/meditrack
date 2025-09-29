<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('status', 'active')->get();
        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $patients = $tag->patients()->with('site')->get();

        return view('tags.show', [
            'tag' => $tag,
            'patients' => $patients,
        ]);
    }

    public function filter(Request $request)
    {
        $tags = Tag::where('status', 'active')->get();
        $selectedTags = $request->input('tags', []);

        $patients = collect();

        if (!empty($selectedTags)) {
            // Ambil pasien yang punya SEMUA tag yang dipilih
            $patients = Patient::whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('tags.id', $selectedTags);
            }, '=', count($selectedTags))
                ->with('site')
                ->get();
        }

        return view('tags.filter', compact('tags', 'patients', 'selectedTags'));
    }
}
