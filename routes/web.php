<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;

// Public routes
Route::get('/', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/guest', [JobOfferController::class, 'index'])->name('guest.jobs');

// Authentication required routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('job-offers', [JobOfferController::class, 'index'])->name('job-offers.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Candidate routes
    Route::middleware('role:candidat')->group(function () {
        Route::get('job-offers.index', [JobOfferController::class, 'index'])->name('jobs.index');
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::post('job-offers/apply/{jobOfferId}', [ApplicationController::class, 'apply'])->name('job-offers.apply');
        Route::get('/job-offers/{jobOffer}', [JobOfferController::class, 'show'])
            ->where('jobOffer', '[0-9]+')
            ->name('job-offers.show');
        Route::get('/my-applications', [CandidateController::class, 'myApplications'])->name('candidate.applications');
        Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
        Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    });

    
    // Recruiter routes
    Route::middleware('role:recruteur')->group(function () {
        Route::resource('job-offers', JobOfferController::class)->except(['index', 'show']);
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
       
        Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    });
});