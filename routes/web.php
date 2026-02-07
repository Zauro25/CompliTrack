<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->get('/dashboard', function () {
    $role = Auth::user()->role ?? null;
    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'auditor' => redirect()->route('auditor.dashboard'),
        default => redirect()->route('home'),
    };
})->name('dashboard');

// Auth routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Staff registration (default register page)
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])
    ->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Auditor registration (special route, only for admin or via invite)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('register-auditor', [App\Http\Controllers\Auth\RegisterAuditorController::class, 'showRegistrationForm'])
        ->name('register.auditor');
    Route::post('register-auditor', [App\Http\Controllers\Auth\RegisterAuditorController::class, 'register']);
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('divisions', App\Http\Controllers\DivisionController::class);
    Route::resource('policies', App\Http\Controllers\PoliciesController::class);
    Route::resource('policies-versions', App\Http\Controllers\PoliciesVersionController::class);
    // Add policy assignment routes if needed
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->as('staff.')->group(function () {
    Route::get('dashboard', function () { return view('staff.dashboard'); })->name('dashboard');
    Route::get('policies', [App\Http\Controllers\PoliciesController::class, 'index'])->name('policies.index');
    Route::resource('checklists', App\Http\Controllers\ChecklistsController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('evidences', App\Http\Controllers\EvidencesController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('compliance-entries', App\Http\Controllers\ComplianceEntriesController::class)->only(['index', 'create', 'store', 'show']);
});

// Auditor routes
Route::middleware(['auth', 'role:auditor'])->prefix('auditor')->as('auditor.')->group(function () {
    Route::get('dashboard', function () { return view('auditor.dashboard'); })->name('dashboard');
    Route::resource('compliance-entries', App\Http\Controllers\ComplianceEntriesController::class)->only(['index', 'show', 'update']);
    Route::resource('audit-reviews', App\Http\Controllers\AuditReviewsController::class)->only(['index', 'show', 'update']);
    // Add more auditor-specific routes as needed
});

require __DIR__.'/settings.php';
