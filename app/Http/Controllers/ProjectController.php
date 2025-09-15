<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserProject;
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
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'project_code' => 'PRJ' . strtoupper(Str::random(6)),
            'voucher_code' => strtoupper(Str::random(8)),
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => Auth::id(),
        ]);

        // Tambahkan juga ke tabel pivot user_projects sebagai owner
        UserProject::create([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
            'role_in_project' => 'owner'
        ]);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project)
    {
        $pageTitle = "Detail Project";
        $project->load('sites');
        return view('projects.show', compact('project', 'pageTitle'));
    }

    public function search(Request $request)
    {
        $pageTitle = "Cari Project";
        $project = null;

        if ($request->filled('project_code')) {
            $project = Project::where('project_code', $request->project_code)->first();
        }

        return view('projects.search', compact('project', 'pageTitle'));
    }

    public function join(Request $request, Project $project)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        if ($request->voucher_code !== $project->voucher_code) {
            return back()->with('error', 'Voucher salah!');
        }

        UserProject::firstOrCreate([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
        ], [
            'role_in_project' => 'viewer',
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Berhasil bergabung ke project.');
    }
}
