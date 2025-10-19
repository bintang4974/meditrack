<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.pro'       => \App\Http\Middleware\CheckPro::class,
            'check.pro.status' => \App\Http\Middleware\CheckProStatus::class,
            'check.free.limit' => \App\Http\Middleware\CheckFreeLimit::class,
            'feature.access' => \App\Http\Middleware\CheckFeatureAccess::class,
        ]);

        // REGISTER web middleware group (versi baru)
        $middleware->web(append: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ]);

        // ✅ Gunakan metode resmi Laravel 11–12 untuk exclude CSRF
        $middleware->validateCsrfTokens(except: [
            'subscription/callback',
            'subscription/clientNotify',
        ]);

        // 🚀 Tambahkan ini untuk men-disable CSRF khusus untuk callback Midtrans
        // $middleware->validateCsrfTokens(except: [
        //     'subscription/callback',
        //     'subscription/clientNotify',
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
