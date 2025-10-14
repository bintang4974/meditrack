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
            'check.pro'       => \App\Http\Middleware\CheckPro::class,
            'check.pro.status' => \App\Http\Middleware\CheckProStatus::class,
            'check.free.limit' => \App\Http\Middleware\CheckFreeLimit::class,
            'feature.access' => \App\Http\Middleware\CheckFeatureAccess::class,
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
