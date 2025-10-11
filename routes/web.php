<?php

use App\Http\Controllers\{
    CategoryController,
    DashboardController,
    DoctorController,
    EntryController,
    LabelController,
    PatientController,
    ProjectController,
    ReportController,
    SiteController,
    TagController
};
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search & Join Project
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::post('/projects/{project}/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::get('/projects/{project}/join-requests', [ProjectController::class, 'joinRequests'])->name('projects.joinRequests');
    Route::post('/projects/{project}/join-requests/{joinRequest}/approve', [ProjectController::class, 'approveRequest'])->name('projects.approveRequest');
    Route::post('/projects/{project}/join-requests/{joinRequest}/reject', [ProjectController::class, 'rejectRequest'])->name('projects.rejectRequest');
    Route::resource('projects', ProjectController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

    // Sites (nested di dalam project)
    Route::get('/projects/{project}/sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('/projects/{project}/sites/create', [SiteController::class, 'create'])->name('sites.create');
    Route::post('/projects/{project}/sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/projects/{project}/sites/{site}', [SiteController::class, 'show'])->name('sites.show');
    Route::get('/projects/{project}/sites/{site}/edit', [SiteController::class, 'edit'])->name('sites.edit');
    Route::put('/projects/{project}/sites/{site}', [SiteController::class, 'update'])->name('sites.update');
    Route::delete('/projects/{project}/sites/{site}', [SiteController::class, 'destroy'])->name('sites.destroy');

    // Patients (nested di dalam site → project)
    Route::get('/projects/{project}/sites/{site}/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/projects/{project}/sites/{site}/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/projects/{project}/sites/{site}/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/projects/{project}/sites/{site}/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // Entries
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

    // TAGS (per project)
    Route::get('/projects/{project}/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/projects/{project}/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/projects/{project}/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/projects/{project}/tags/filter', [TagController::class, 'filter'])->name('tags.filter');
    Route::get('/projects/{project}/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/projects/{project}/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/projects/{project}/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/projects/{project}/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    Route::patch('/projects/{project}/tags/{tag}/toggle', [TagController::class, 'toggleStatus'])->name('tags.toggle');

    // LABELS (per project)
    Route::get('/projects/{project}/labels', [LabelController::class, 'index'])->name('labels.index');
    Route::get('/projects/{project}/labels/create', [LabelController::class, 'create'])->name('labels.create');
    Route::post('/projects/{project}/labels', [LabelController::class, 'store'])->name('labels.store');
    Route::get('/projects/{project}/labels/filter', [LabelController::class, 'filter'])->name('labels.filter');
    Route::get('/projects/{project}/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
    Route::get('/projects/{project}/labels/{label}/edit', [LabelController::class, 'edit'])->name('labels.edit');
    Route::put('/projects/{project}/labels/{label}', [LabelController::class, 'update'])->name('labels.update');
    Route::delete('/projects/{project}/labels/{label}', [LabelController::class, 'destroy'])->name('labels.destroy');
    Route::patch('/projects/{project}/labels/{label}/toggle', [LabelController::class, 'toggleStatus'])->name('labels.toggle');
    Route::get('/projects/{project}/labels/filter', [LabelController::class, 'filter'])->name('labels.filter');

    // REPORT
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
    Route::post('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
    Route::post('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/sites/{project}', [ReportController::class, 'getSites'])->name('reports.getSites');
});
