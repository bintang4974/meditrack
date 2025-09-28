<?php

namespace App\Http\Controllers;

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
}
