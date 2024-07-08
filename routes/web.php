<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/course/{subject}/answers', [CourseController::class, 'answers'])->name('course.answers');
});
