<?php

namespace App\Http\Middleware;

use App\Models\Entry;
use App\Models\Project;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFreeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        $user = Auth::user();

        // Jika Pro, lewati
        if ($user->membership === 'pro') {
            return $next($request);
        }

        // Free user
        if ($type === 'project') {
            $count = Project::where('owner_id', $user->id)->count();
            if ($count >= 2) {
                return back()->with('error', 'Batas maksimal 2 project untuk akun Free.');
            }
        }

        if ($type === 'entry') {
            $monthlyCount = Entry::where('created_by', $user->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            if ($monthlyCount >= 5) {
                return back()->with('error', 'Batas maksimal 5 entries per bulan untuk akun Free.');
            }

            // ❌ Tidak boleh upload file/gambar
            if ($request->hasFile('image_file') || $request->hasFile('document_file')) {
                return back()->with('error', 'Upload file hanya tersedia untuk akun Pro.');
            }
        }

        return $next($request);
    }
}
