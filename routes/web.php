<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
    Route::get('/course/browse', [CourseController::class, 'browse'])->name('course.browse');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/course/{course}/answers', [CourseController::class, 'answers'])->name('course.answers');
    Route::get('/profile/courses', [UserController::class, 'courses'])->name('profile.courses');
});

Route::fallback(function () {
    Inertia::render('Error', ['message' => 'Page not found.']);
});
