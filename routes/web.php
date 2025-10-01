<?php

use App\Http\Controllers\{
    CategoryController,
    DashboardController,
    DoctorController,
    EntryController,
    LabelController,
    PatientController,
    ProjectController,
    SiteController,
    TagController
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

    // Search & Join Project
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::post('/projects/{project}/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::get('/projects/{project}/join-requests', [ProjectController::class, 'joinRequests'])->name('projects.joinRequests');
    Route::post('/projects/{project}/join-requests/{joinRequest}/approve', [ProjectController::class, 'approveRequest'])->name('projects.approveRequest');
    Route::post('/projects/{project}/join-requests/{joinRequest}/reject', [ProjectController::class, 'rejectRequest'])->name('projects.rejectRequest');
    Route::resource('projects', ProjectController::class)->only(['index', 'create', 'store', 'show']);
    // Sites (nested di dalam project)
    Route::get('/projects/{project}/sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('/projects/{project}/sites/create', [SiteController::class, 'create'])->name('sites.create');
    Route::post('/projects/{project}/sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/projects/{project}/sites/{site}', [SiteController::class, 'show'])->name('sites.show');
    // Patients (nested di dalam site → project)
    Route::get('/projects/{project}/sites/{site}/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/projects/{project}/sites/{site}/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/create', [EntryController::class, 'create'])->name('entries.create');
    Route::post('/projects/{project}/sites/{site}/patients/{patient}/entries', [EntryController::class, 'store'])->name('entries.store');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/{entry}', [EntryController::class, 'show'])->name('entries.show');
    Route::get('/entries/form-fields/{category}', [EntryController::class, 'formFields'])->name('entries.formFields');

    // Doctors (nested di dalam project)
    Route::get('/projects/{project}/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/projects/{project}/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/projects/{project}/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/projects/{project}/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/projects/{project}/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/projects/{project}/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');


    Route::get('/sub-categories/{category}', [CategoryController::class, 'subCategories']);
    Route::get('/categories/{category}/sub-categories', [EntryController::class, 'getSubCategories'])->name('categories.subCategories');

    Route::resource('entries', EntryController::class)->only(['index']);

    // tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/filter', [TagController::class, 'filter'])->name('tags.filter');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

    // Labels
    Route::get('/labels', [LabelController::class, 'index'])->name('labels.index');
    Route::get('/labels/filter', [LabelController::class, 'filter'])->name('labels.filter');
    Route::get('/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
});
