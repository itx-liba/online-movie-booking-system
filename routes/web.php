<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TheaterController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ShowController;

// Public home page
 Route::get('/', [MovieController::class, 'home']);

// Static pages
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');
Route::view('/faqs', 'pages.faqs');

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

// User dashboard (authenticated)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Movies listing and details
 Route::get('/movies', [MovieController::class, 'index']);
 Route::get('/movies/{movie}', [MovieController::class, 'show']);

// Reviews (only for logged-in users)
Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->middleware('auth');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/bookings/create/{movieShow}', [BookingController::class, 'create']);
    Route::post('/bookings/{movieShow}', [BookingController::class, 'store']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});

// Admin panel routes (auth + admin only)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Theater management
    Route::get('/theaters', [TheaterController::class, 'index']);
    Route::get('/theaters/create', [TheaterController::class, 'create']);
    Route::post('/theaters', [TheaterController::class, 'store']);
    Route::get('/theaters/{theater}/edit', [TheaterController::class, 'edit']);
    Route::put('/theaters/{theater}', [TheaterController::class, 'update']);
    Route::delete('/theaters/{theater}', [TheaterController::class, 'destroy']);
    
    // Movie management (admin)
    Route::get('/movies', [AdminMovieController::class, 'index']);
    Route::get('/movies/create', [AdminMovieController::class, 'create']);
    Route::post('/movies', [AdminMovieController::class, 'store']);
    Route::get('/movies/{movie}/edit', [AdminMovieController::class, 'edit']);
    Route::put('/movies/{movie}', [AdminMovieController::class, 'update']);
    Route::delete('/movies/{movie}', [AdminMovieController::class, 'destroy']);

    // Show management
    Route::get('/shows', [ShowController::class, 'index']);
    Route::get('/shows/create', [ShowController::class, 'create']);
    Route::post('/shows', [ShowController::class, 'store']);
    Route::get('/shows/{movieShow}/edit', [ShowController::class, 'edit']);
    Route::put('/shows/{movieShow}', [ShowController::class, 'update']);
    Route::delete('/shows/{movieShow}', [ShowController::class, 'destroy']);

    // Admin data views
    Route::get('/users', [DashboardController::class, 'users']);
    Route::get('/bookings', [DashboardController::class, 'bookings']);
});