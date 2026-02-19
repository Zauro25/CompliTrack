<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;


// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Auth routes
Route::get('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])
    ->name('admin.login.submit');
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.store');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Staff registration (default register page)
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])
    ->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.store');

// Auditor registration (special route, only for admin or via invite)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('register-auditor', [App\Http\Controllers\Auth\RegisterAuditorController::class, 'showRegistrationForm'])
        ->name('register.auditor');
    Route::post('register-auditor', [App\Http\Controllers\Auth\RegisterAuditorController::class, 'register']);
    Route::post('register-admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])
        ->name('register.admin');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('divisions', App\Http\Controllers\DivisionController::class);
    Route::resource('policies', App\Http\Controllers\PoliciesController::class);
    Route::resource('policies-versions', App\Http\Controllers\PoliciesVersionController::class);
    // Add policy assignment routes if needed
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->as('staff.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'staffDashboard'])->name('dashboard');
    Route::get('policies', [App\Http\Controllers\PoliciesController::class, 'index'])->name('policies.index');
    Route::resource('checklists', App\Http\Controllers\ChecklistsController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
    Route::get('evidences/{id}/file', [App\Http\Controllers\EvidencesController::class, 'viewFile'])->name('evidences.file');
    Route::resource('evidences', App\Http\Controllers\EvidencesController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('compliance-entries', App\Http\Controllers\ComplianceEntriesController::class)->only(['index', 'create', 'store', 'show']);
});

// Auditor routes
Route::middleware(['auth', 'role:auditor'])->prefix('auditor')->as('auditor.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'auditorDashboard'])->name('dashboard');
    Route::get('evidences/{id}/file', [App\Http\Controllers\EvidencesController::class, 'viewFile'])->name('evidences.file');
    Route::resource('compliance-entries', App\Http\Controllers\ComplianceEntriesController::class)->only(['index', 'show', 'update']);
    Route::resource('audit-reviews', App\Http\Controllers\AuditReviewsController::class)->only(['index', 'store', 'show', 'update']);
    // Add more auditor-specific routes as needed
});

require __DIR__.'/settings.php';
