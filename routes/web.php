<?php

use App\Http\Controllers\{
    CategoryController,
    DashboardController,
    DoctorController,
    EntryController,
    PatientController,
    ProjectController,
    SiteController
};
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/', fn() => redirect()->route('login'));

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::post('/projects/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::resource('projects', ProjectController::class)->only(['index', 'create', 'store', 'show']);
    // Search & Join Project
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::post('/projects/{project}/join', [ProjectController::class, 'join'])->name('projects.join');
    // Sites (nested di dalam project)
    Route::get('/projects/{project}/sites/create', [SiteController::class, 'create'])->name('sites.create');
    Route::post('/projects/{project}/sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/projects/{project}/sites/{site}', [SiteController::class, 'show'])->name('sites.show');
    // Patients (nested di dalam site → project)
    Route::get('/projects/{project}/sites/{site}/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/projects/{project}/sites/{site}/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');

    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/create', [EntryController::class, 'create'])->name('entries.create');
    Route::post('/projects/{project}/sites/{site}/patients/{patient}/entries', [EntryController::class, 'store'])->name('entries.store');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/{entry}', [EntryController::class, 'show'])->name('entries.show');
    Route::get('/entries/form-fields/{category}', [EntryController::class, 'formFields'])->name('entries.formFields');


    // form create entry untuk project tertentu
    // Route::get('/projects/{project}/entries/create', [EntryController::class, 'create'])->name('projects.entries.create');
    // Route::post('/projects/{project}/entries', [EntryController::class, 'store'])->name('projects.entries.store');

    Route::resource('entries', EntryController::class)->only(['index']);
    // ajax form field loader
    // Route::get('/entries/form-fields/{category}', [EntryController::class, 'formFields'])->name('entries.formFields');


    // Route::resource('sites', SiteController::class)->except(['show']);
    // Route::resource('categories', CategoryController::class)->except(['show']);
    // Route::resource('patients', PatientController::class)->except(['show']);
    // Route::resource('doctors', DoctorController::class);
});
