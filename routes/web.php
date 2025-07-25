<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes (handled by auth.php)
require __DIR__.'/auth.php';

// Social Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    // Basic social authentication
    Route::get('{provider}', [SocialiteController::class, 'redirect'])->name('redirect');
    Route::get('{provider}/callback', [SocialiteController::class, 'callback'])->name('callback');
    
    // Role-specific social authentication
    Route::get('{provider}/{role}', [SocialiteController::class, 'redirectWithRole'])->name('redirect.role');
    Route::get('{provider}/{role}/callback', [SocialiteController::class, 'callbackWithRole'])->name('callback.role');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // General dashboard route - redirects based on user role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin routes
    Route::middleware(['role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
    });
    
    // User routes
    Route::middleware(['role:user,customer,wholeseller,seller'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    });
    
    // Settings routes (using Volt components)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'profile');
        
        Volt::route('profile', 'settings.profile')->name('profile');
        Volt::route('password', 'settings.password')->name('password');
        Volt::route('appearance', 'settings.appearance')->name('appearance');
    });
    
});

// Fallback route for 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
})->name('fallback');
