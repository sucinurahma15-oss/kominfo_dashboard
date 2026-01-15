<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialMediaAccountController;
use App\Http\Controllers\SocialMediaStatisticController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Redirect root to login if not authenticated
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

// Auth routes - Only login is public, register is disabled
Auth::routes(['register' => false]);

// All dashboard routes protected by auth middleware
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - Main
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Social Media Accounts Management
    Route::resource('accounts', SocialMediaAccountController::class);

    // Statistics Management
    Route::resource('statistics', SocialMediaStatisticController::class)->except(['show']);

    // Export Routes
    Route::get('/export', [ExportController::class, 'showExportForm'])->name('export.form');
    Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');

    // Admin Management Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'index'])->name('users');
        Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminController::class, 'register'])->name('register.post');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    });
});

// Catch-all route for undefined routes - redirect to login
Route::fallback(function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});