<?php

namespace App\Http\Middleware;

use App\Models\Entry;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFeatureAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $feature  tipe fitur yang ingin dicek, misalnya:
     *  - "project_create"
     *  - "entry_create"
     *  - "upload"
     *  - "tag_manage"
     *  - "label_manage"
     *  - "report_export"
     */
    public function handle(Request $request, Closure $next, string $feature): Response
    {
        $user = Auth::user();

        // Jika user Pro & masih aktif → lewati
        if ($user->membership === 'pro' && $user->subscription_ends_at && now()->lt($user->subscription_ends_at)) {
            return $next($request);
        }

        // Jika bukan Pro (Free atau expired)
        switch ($feature) {
            // 🧱 LIMIT PROJECT
            case 'project_create':
                $count = Project::where('owner_id', $user->id)->count();
                if ($count >= 2) {
                    return back()->with('error', 'Batas maksimal 2 project untuk akun Free.');
                }
                break;

            // 🧾 LIMIT ENTRY
            case 'entry_create':
                $monthlyCount = Entry::where('created_by', $user->id)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                if ($monthlyCount >= 5) {
                    return back()->with('error', 'Batas maksimal 5 entries per bulan untuk akun Free.');
                }

                if ($request->hasFile('image_file') || $request->hasFile('document_file')) {
                    return back()->with('error', 'Upload file hanya tersedia untuk akun Pro.');
                }
                break;

            // 📁 UPLOAD UMUM
            case 'upload':
                if ($request->hasFile('file') || $request->hasFile('document_file') || $request->hasFile('image_file')) {
                    return back()->with('error', 'Upload file hanya untuk akun Pro.');
                }
                break;

            // 🏷️ TAGS MANAGEMENT
            case 'tag_manage':
                return back()->with('error', 'Manajemen Tag hanya tersedia untuk akun Pro.');

                // 🪣 LABELS MANAGEMENT
            case 'label_manage':
                return back()->with('error', 'Manajemen Label hanya tersedia untuk akun Pro.');

                // 📊 EXPORT REPORT
            case 'report_export':
                return back()->with('error', 'Ekspor laporan hanya tersedia untuk akun Pro.');

                // 📦 CATEGORIES / ADVANCED FILTER
            case 'category_manage':
                return back()->with('error', 'Manajemen Kategori hanya tersedia untuk akun Pro.');

            default:
                break;
        }

        return $next($request);
    }
}
