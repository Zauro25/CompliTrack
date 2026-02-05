<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Resource routes for each model
use App\Http\Controllers\AuditReviewsController;
use App\Http\Controllers\ChecklistsController;
use App\Http\Controllers\ComplianceEntriesController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EvidencesController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\PoliciesVersionController;
use App\Http\Controllers\UserController;

// Public API Auth routes
Route::post('register', [UserController::class, 'register']); // staff only
Route::post('register-admin', [UserController::class, 'registerAdmin']);
Route::post('register-auditor', [UserController::class, 'registerAuditor']);
Route::post('login', [UserController::class, 'login']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
	Route::post('logout', [UserController::class, 'logout']);
	Route::apiResource('audit-reviews', AuditReviewsController::class);
	Route::apiResource('checklists', ChecklistsController::class);
	Route::apiResource('compliance-entries', ComplianceEntriesController::class);
	Route::apiResource('divisions', DivisionController::class);
	Route::apiResource('evidences', EvidencesController::class);
	Route::apiResource('policies', PoliciesController::class);
	Route::apiResource('policies-versions', PoliciesVersionController::class);
	Route::apiResource('users', UserController::class);
});
