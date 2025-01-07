<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoverLetterController;

Route::get('/', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/guest', [JobOfferController::class, 'index'])->name('guest.jobs');

Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('job-offers', [JobOfferController::class, 'index'])->name('job-offers.index');
    Route::get('job-offers', [JobOfferController::class, 'index'])->name('job-offers.index');
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for Candidat (role: candidat)
Route::middleware('auth')->group(function () {
    Route::middleware('role:candidat')->group(function () {
        Route::resource('cvs', CVController::class);
        Route::resource('cover-letters', CoverLetterController::class);
        Route::get('job-offers.index', [JobOfferController::class, 'index'])->name('jobs.index');
       
        Route::get('/cvs/create', [CVController::class, 'create'])->name('cvs.create');
        Route::post('/cvs/store', [CVController::class, 'store'])->name('cvs.store');
        Route::resource('cvs', CVController::class)->except(['show', 'edit', 'update']);
        Route::get('cvs/download/{user}', [CVController::class, 'download'])->name('cvs.download');
        Route::resource('cover-letters', CoverLetterController::class)->except(['show']);
        Route::get('/cover-letters/{coverLetter}/download', [CoverLetterController::class, 'download'])->name('cover-letters.download');
       
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::post('job-offers/apply/{jobOfferId}', [ApplicationController::class, 'apply'])->name('job-offers.apply');


Route::middleware(['auth'])->group(function () {
    Route::get('/my-applications', [CandidateController::class, 'myApplications'])->name('candidate.applications');
});

Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');





    });
});

// Routes for Recruteur (role: recruteur)
Route::middleware('auth')->group(function () {
    Route::middleware('role:recruteur')->group(function () {
        Route::resource('job-offers', JobOfferController::class)->except(['index']);
        Route::get('job-offers/create', [JobOfferController::class, 'create'])->name('job-offers.create');
        Route::post('job-offers', [JobOfferController::class, 'store'])->name('job-offers.store');
        Route::get('job-offers', [JobOfferController::class, 'index'])->name('job-offers.index');
        Route::resource('job-offers', JobOfferController::class)->except(['show', 'edit', 'update']);
        Route::delete('job-offers/{jobOffer}', [JobOfferController::class, 'destroy'])->name('job-offers.destroy');
        // Add the edit route for the job offers
     Route::get('job-offers/{jobOffer}/edit', [JobOfferController::class, 'edit'])->name('job-offers.edit');
Route::put('job-offers/{jobOffer}', [JobOfferController::class, 'update'])->name('job-offers.update');
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::patch('/applications/{application}/update-status', [ApplicationController::class, 'updateStatus'])->name('applications.update-status');

    });
    
});
