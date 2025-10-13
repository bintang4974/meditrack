<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $feature = null): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // auto-downgrade jika Pro sudah expired
        if ($user->membership === 'pro' && $user->subscription_ends_at && Carbon::now()->gt($user->subscription_ends_at)) {
            $user->update(['membership' => 'free']);
        }

        // Batasan fitur akun Free
        if ($user->membership === 'free') {
            switch ($feature) {
                case 'create_project':
                    if ($user->projects()->count() >= 2) {
                        return back()->with('error', 'Batas maksimal 2 project untuk akun gratis.');
                    }
                    break;

                case 'create_entry':
                    $countThisMonth = $user->entries()
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count();
                    if ($countThisMonth >= 5) {
                        return back()->with('error', 'Batas maksimal 5 entries per bulan untuk akun gratis.');
                    }
                    break;

                case 'upload_file':
                case 'manage_label':
                case 'manage_tag':
                case 'manage_category':
                    return back()->with('error', 'Fitur ini hanya tersedia untuk akun Pro.');
            }
        }

        return $next($request);
        // return $next($request);
    }
}
