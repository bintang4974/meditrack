<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->membership === 'pro') {
            if ($user->subscription_ends_at && Carbon::now()->greaterThan($user->subscription_ends_at)) {
                // downgrade otomatis
                $user->update(['membership' => 'expired_pro']);
            }
        }

        return $next($request);
    }
}
