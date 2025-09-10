<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $pageTitle = 'Project';
        $projects = Auth::user()->projects;

        return view('projects.index', compact('projects', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Create Project';

        return view('projects.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $voucher = strtoupper(Str::random(8)); // generate kode voucher unik

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'voucher_code' => $voucher,
            'owner_id' => Auth::id(),
        ]);

        // otomatis owner jadi user_projects
        Auth::user()->projects()->attach($project->id, ['role_in_project' => 'owner']);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat!');
    }

    public function join(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string|exists:projects,voucher_code',
        ]);

        $project = Project::where('voucher_code', $request->voucher_code)->first();

        Auth::user()->projects()->syncWithoutDetaching([
            $project->id => ['role_in_project' => 'member']
        ]);

        return redirect()->route('projects.index')->with('success', 'Berhasil join project!');
    }
}
