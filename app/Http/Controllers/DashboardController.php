<?php

namespace App\Http\Controllers;

use App\Models\{Doctor, Entry, Patient, Project, ProjectJoinRequest, Site};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin melihat semua data
            $stats = [
                'projects' => Project::count(),
                'sites' => Site::count(),
                'doctors' => Doctor::count(),
                'patients' => Patient::count(),
                'entries' => Entry::count(),
            ];

            $entriesByCategory = Entry::with('category')
                ->get()
                ->groupBy(fn($e) => $e->category->category_main ?? 'Unknown')
                ->map->count();

            $entriesByMonth = Entry::selectRaw("DATE_FORMAT(entry_date, '%Y-%m') as month, COUNT(*) as total")
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');

            $recentEntries = Entry::with(['category', 'createdBy'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.admin', compact('pageTitle', 'stats', 'entriesByCategory', 'entriesByMonth', 'recentEntries'));
        } else {
            // Dokter/Member melihat data pribadi
            $projects = $user->projects;
            $entries = Entry::where('created_by', $user->id)->with('category')->latest()->take(5)->get();

            $stats = [
                'projects' => $projects->count(),
                'patients' => Patient::whereIn('site_id', $projects->pluck('sites.*.id'))->count(),
                'entries' => Entry::where('created_by', $user->id)->count(),
            ];

            $upcoming = Entry::where('created_by', $user->id)
                ->where('waitlist_status', 'SCHEDULED')
                ->orderBy('waitlist_scheduled_date')
                ->take(5)
                ->get();

            // pending requests hanya kalau dia owner project
            $pendingRequests = ProjectJoinRequest::whereHas('project', function ($q) use ($user) {
                $q->where('owner_id', $user->id);
            })->where('status', 'pending')->count();

            return view('dashboard.doctor', compact('pageTitle', 'stats', 'projects', 'entries', 'upcoming', 'pendingRequests'));
        }
    }
}
