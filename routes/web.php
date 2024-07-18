<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Grouped by prefix '/dashboard'
Route::prefix('dashboard')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
});

// Grouped by prefix '/favourite'
Route::prefix('favourite')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/{course}/store', [FavouriteController::class, 'store'])->name('favourite.store');
});

// Grouped by prefix '/course'
Route::prefix('course')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/browse', [CourseController::class, 'browse'])->name('course.browse');
    Route::get('/create', [CourseController::class, 'create'])->name('course.create')->middleware([RoleMiddleware::class]);
    Route::get('/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/{course}/answers', [CourseController::class, 'answers'])->name('course.answers');
});

// Grouped by prefix '/profile'
Route::prefix('profile')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/courses', [UserController::class, 'courses'])->name('profile.courses');
    Route::get('/favourites', [UserController::class, 'favourites'])->name('profile.favourites');
});

// Error route outside of any prefix
Route::get('/error', function (Request $request) {
    return Inertia::render('Error');
});
