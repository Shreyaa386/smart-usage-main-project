<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\ProfileController;

// Landing / Login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('auth.login');
})->name('login');

// Auth routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

    Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard & Usages
    Route::get('/dashboard', [UsageController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/add-usage', [UsageController::class, 'create'])->name('add-usage');
    Route::post('/add-usage', [UsageController::class, 'store'])->name('add-usage.store');
    
    Route::get('/history', [UsageController::class, 'history'])->name('history');
    Route::post('/history/{id}', [UsageController::class, 'destroy'])->name('history.destroy');
    
    Route::get('/analytics', [UsageController::class, 'analytics'])->name('analytics');
    Route::get('/alerts', [UsageController::class, 'alerts'])->name('alerts');

    // Admin
    Route::post('/admin/clear-cache', [AuthController::class, 'clearCache'])->name('admin.clear-cache');
});
