<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectJoinRequest;
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
        $code = $request->input('project_code');

        $project = Project::where('project_code', $code)
            ->orWhere('voucher_code', $code)
            ->first();

        if (!$project) {
            return back()->with('error', 'Project dengan kode tersebut tidak ditemukan.');
        }

        // kalau sudah join, langsung redirect ke show
        if ($project->users()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('projects.show', $project->id)->with('info', 'Kamu sudah tergabung dalam project ini.');
        }

        return view('projects.search_result', [
            'project' => $project,
            'pageTitle' => 'Hasil Pencarian Project'
        ]);
    }

    public function join(Request $request, Project $project)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        if ($request->voucher_code !== $project->voucher_code) {
            return back()->with('error', 'Voucher salah!');
        }

        // Cek kalau sudah pernah request
        $existing = ProjectJoinRequest::where('user_id', auth()->id())
            ->where('project_id', $project->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('info', 'Kamu sudah mengajukan join, tunggu persetujuan owner.');
        }

        ProjectJoinRequest::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'voucher_code' => $request->voucher_code,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Permintaan join dikirim. Menunggu persetujuan owner.');
    }

    public function joinRequests(Project $project)
    {
        // Pastikan hanya owner project yang bisa akses
        if ($project->owner_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Ambil semua pending requests
        $requests = $project->joinRequests()->with('user')->get();

        $pageTitle = "Permintaan Join Project";

        return view('projects.join_requests', compact('project', 'requests', 'pageTitle'));
    }

    public function approveRequest(Request $request, Project $project, ProjectJoinRequest $joinRequest)
    {
        $request->validate([
            'role_in_project' => 'required|in:member,supervisor',
        ]);

        if ($joinRequest->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        // Insert ke user_projects
        UserProject::create([
            'user_id' => $joinRequest->user_id,
            'project_id' => $project->id,
            'role_in_project' => $request->role_in_project,
        ]);

        $joinRequest->update(['status' => 'approved']);

        return back()->with('success', 'User berhasil ditambahkan ke project.');
    }

    public function rejectRequest(Project $project, ProjectJoinRequest $joinRequest)
    {
        if ($joinRequest->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        $joinRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan join ditolak.');
    }
}
