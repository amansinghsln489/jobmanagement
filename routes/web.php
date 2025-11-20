<?php
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Authenticated Routes (CRUD)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/from/from', [JobController::class, 'from'])->name('from.from');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.save');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::post('/jobs/{job}', [JobController::class, 'jobUpdate'])->name('jobs.jobupdate');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/trashed', [JobController::class, 'trashed'])->name('jobs.trashed');
});


Route::middleware(['auth', 'verified'])->group(function () {
   
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

// Breeze Auth Routes (profile, etc.)
require __DIR__.'/auth.php';