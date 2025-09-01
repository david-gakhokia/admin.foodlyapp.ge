<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Analytics Web Routes
|--------------------------------------------------------------------------
|
| Web routes for Analytics & Reporting module UI
|
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('analytics')->name('analytics.web.')->group(function () {
        
        // Dashboard Overview
        Route::get('/dashboard', function () {
            return view('admin.analytics.dashboard');
        })->name('dashboard');
        
        // BOG Payment Analytics
        Route::get('/bog-payments', function () {
            return view('admin.analytics.bog-payments');
        })->name('bog-payments');
        
        // Reservation Analytics
        Route::get('/reservations', function () {
            return view('admin.analytics.reservations');
        })->name('reservations');
        
        // Revenue Analytics
        Route::get('/revenue', function () {
            return view('admin.analytics.revenue');
        })->name('revenue');
        
        // Conversion Funnel
        Route::get('/conversion-funnel', function () {
            return view('admin.analytics.conversion-funnel');
        })->name('conversion-funnel');
        
        // Real-time Analytics
        Route::get('/real-time', function () {
            return view('admin.analytics.real-time');
        })->name('real-time');
        
        // Reports Management
        Route::get('/reports', function () {
            return view('admin.analytics.reports');
        })->name('reports');
    });
});
