<?php

use App\Http\Middleware\CheckSubscription;
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
            'check.pro.status' => \App\Http\Middleware\CheckProStatus::class,
            'pro' => \App\Http\Middleware\CheckPro::class,
            'free' => \App\Http\Middleware\CheckFreeLimit::class,
        ]);
        // middleware global (jika ingin global)
        // $middleware->use(SomeGlobalMiddleware::class);

        // middleware route
        // $middleware->alias([
        //     'check.subscription' => CheckSubscription::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
