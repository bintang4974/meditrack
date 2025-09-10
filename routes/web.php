<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/', fn() => redirect()->route('login'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    // Route::post('/projects/join', [ProjectController::class, 'join'])->name('projects.join');

    // Route::resource('entries', EntryController::class)->only(['index','create','store','show']);
});
