<?php

use App\Http\Controllers\{
    AuthController,
    CategoryController,
    DashboardController,
    DoctorController,
    EntryController,
    LabelController,
    PatientController,
    ProjectController,
    ReportController,
    SiteController,
    SubscriptionController,
    TagController
};
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));
Route::get('/landing', function () {
    return view('landing');
});

// Auth (default Laravel + Google)
Auth::routes();
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// =========================================
// 🔐 AUTHENTICATED AREA
// =========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===============================
    // 🧱 PROJECTS
    // ===============================
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::post('/projects/{project}/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::get('/projects/{project}/join-requests', [ProjectController::class, 'joinRequests'])->name('projects.joinRequests');
    Route::post('/projects/{project}/join-requests/{joinRequest}/approve', [ProjectController::class, 'approveRequest'])->name('projects.approveRequest');
    Route::post('/projects/{project}/join-requests/{joinRequest}/reject', [ProjectController::class, 'rejectRequest'])->name('projects.rejectRequest');

    // Index, detail, edit dll tetap bebas diakses
    Route::resource('projects', ProjectController::class)->only(['index', 'create', 'show', 'edit', 'update', 'destroy']);

    // ✅ Batasi pembuatan Project untuk Free user
    Route::post('/projects', [ProjectController::class, 'store'])
        ->middleware(['feature.access:project_create'])
        ->name('projects.store');

    // ===============================
    // 🏥 SITES (nested)
    // ===============================
    Route::prefix('/projects/{project}/sites')->group(function () {
        Route::get('/', [SiteController::class, 'index'])->name('sites.index');
        Route::get('/create', [SiteController::class, 'create'])->name('sites.create');
        Route::post('/', [SiteController::class, 'store'])->name('sites.store');
        Route::get('/{site}', [SiteController::class, 'show'])->name('sites.show');
        Route::get('/{site}/edit', [SiteController::class, 'edit'])->name('sites.edit');
        Route::put('/{site}', [SiteController::class, 'update'])->name('sites.update');
        Route::delete('/{site}', [SiteController::class, 'destroy'])->name('sites.destroy');
    });

    // ===============================
    // 👨‍⚕️ PATIENTS (nested → site)
    // ===============================
    Route::prefix('/projects/{project}/sites/{site}/patients')->group(function () {
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/{patient}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    });

    // ===============================
    // 🧾 ENTRIES
    // ===============================
    Route::get('/entries/form-fields/{category}', [EntryController::class, 'formFields'])->name('entries.formFields');
    Route::get('/categories/{category}/sub-categories', [EntryController::class, 'getSubCategories'])->name('categories.subCategories');

    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/create', [EntryController::class, 'create'])
        ->name('entries.create');

    Route::get('/projects/{project}/sites/{site}/patients/{patient}/entries/{entry}', [EntryController::class, 'show'])
        ->name('entries.show');

    // ✅ Batasi penambahan Entry untuk Free user
    Route::post('/projects/{project}/sites/{site}/patients/{patient}/entries', [EntryController::class, 'store'])
        ->middleware(['feature.access:entry_create'])
        ->name('entries.store');

    // ===============================
    // 🩺 DOCTORS (nested)
    // ===============================
    Route::prefix('/projects/{project}/doctors')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('/', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::put('/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
        Route::delete('/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    });

    // ===============================
    // 🏷️ TAGS (Pro Only)
    // ===============================
    Route::resource('/projects/{project}/tags', TagController::class)
        ->except(['index', 'show'])
        ->middleware(['feature.access:tag_manage']);

    Route::get('/projects/{project}/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/projects/{project}/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/projects/{project}/tags/filter', [TagController::class, 'filter'])->name('tags.filter');
    Route::patch('/projects/{project}/tags/{tag}/toggle', [TagController::class, 'toggleStatus'])->name('tags.toggle');

    // ===============================
    // 🪣 LABELS (Pro Only)
    // ===============================
    Route::resource('/projects/{project}/labels', LabelController::class)
        ->except(['index', 'show'])
        ->middleware(['feature.access:label_manage']);

    Route::get('/projects/{project}/labels', [LabelController::class, 'index'])->name('labels.index');
    Route::get('/projects/{project}/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
    Route::get('/projects/{project}/labels/filter', [LabelController::class, 'filter'])->name('labels.filter');
    Route::patch('/projects/{project}/labels/{label}/toggle', [LabelController::class, 'toggleStatus'])->name('labels.toggle');

    // ===============================
    // 📊 REPORTS
    // ===============================
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
    Route::get('/reports/sites/{project}', [ReportController::class, 'getSites'])->name('reports.getSites');

    // ✅ Ekspor laporan hanya untuk Pro
    Route::post('/reports/export/excel', [ReportController::class, 'exportExcel'])
        ->middleware(['feature.access:report_export'])
        ->name('reports.export.excel');

    Route::post('/reports/export/pdf', [ReportController::class, 'exportPdf'])
        ->middleware(['feature.access:report_export'])
        ->name('reports.export.pdf');

    // ===============================
    // 💳 SUBSCRIPTION
    // ===============================
    // routes/web.php (di dalam group auth)
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/create', [SubscriptionController::class, 'createTransaction'])->name('subscription.create');
    Route::post('/subscription/notify', [SubscriptionController::class, 'clientNotify'])->name('subscription.clientNotify'); // optional: client post after snap.onSuccess
    Route::get('/subscription/history', [SubscriptionController::class, 'history'])->name('subscription.history');
});
Route::post('/subscription/callback', [SubscriptionController::class, 'callback'])->name('subscription.callback'); // midtrans server callback
