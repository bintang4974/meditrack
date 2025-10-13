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

        // Jika user bukan free, lewati
        if ($user->membership !== 'free') {
            return $next($request);
        }

        if ($type === 'project') {
            $count = Project::where('owner_id', $user->id)->count();
            if ($count >= 2) {
                return redirect()->back()->with('error', 'Batas maksimal 2 project untuk akun Free.');
            }
        }

        if ($type === 'entry') {
            $count = Entry::where('created_by', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();

            if ($count >= 5) {
                return redirect()->back()->with('error', 'Batas maksimal 5 entries per bulan untuk akun Free.');
            }
        }

        return $next($request);
        // return $next($request);
    }
}
