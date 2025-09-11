<?php

use App\Http\Controllers\{DashboardController, EntryController, ProjectController};
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/', fn() => redirect()->route('login'));

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    Route::post('/projects/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::resource('projects', ProjectController::class)->only(['index', 'create', 'store', 'show']);
    // form create entry untuk project tertentu
    Route::get('/projects/{project}/entries/create', [EntryController::class, 'create'])->name('projects.entries.create');
    Route::post('/projects/{project}/entries', [EntryController::class, 'store'])->name('projects.entries.store');

    Route::resource('entries', EntryController::class)->only(['index','create','store','show']);
    // ajax form field loader
    Route::get('/entries/form-fields/{category}', [EntryController::class, 'formFields'])->name('entries.formFields');
});
