<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->membership !== 'pro') {
            return redirect()->route('subscription.index')
                ->with('error', 'Fitur ini hanya tersedia untuk pengguna Pro.');
        }

        return $next($request);
        // return $next($request);
    }
}
