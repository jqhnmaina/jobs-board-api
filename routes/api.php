<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::get('/companies/{company}/job-applications', [JobApplicationController::class, 'companyApplications']);
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('job-postings', JobPostingController::class);
    Route::get('/job-applications', [JobApplicationController::class, 'index']);
    Route::post('/job-applications', [JobApplicationController::class, 'store']);
    Route::get('/job-applications/{jobApplication}', [JobApplicationController::class, 'show']);
});
