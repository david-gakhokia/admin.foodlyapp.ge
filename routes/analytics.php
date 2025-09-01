<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AnalyticsReportController;

/*
|--------------------------------------------------------------------------
| Analytics Routes
|--------------------------------------------------------------------------
|
| Routes for Analytics & Reporting module
|
*/

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('analytics')->name('analytics.')->group(function () {
        
        // Dashboard Overview
        Route::get('/dashboard', [AnalyticsController::class, 'dashboard'])
            ->name('dashboard');
        
        // BOG Payment Analytics
        Route::get('/bog-payments', [AnalyticsController::class, 'bogPaymentAnalytics'])
            ->name('bog-payments');
        
        // Reservation Analytics
        Route::get('/reservations', [AnalyticsController::class, 'reservationAnalytics'])
            ->name('reservations');
        
        // Revenue Analytics
        Route::get('/revenue', [AnalyticsController::class, 'revenueAnalytics'])
            ->name('revenue');
        
        // Top Performing Restaurants
        Route::get('/top-restaurants', [AnalyticsController::class, 'topRestaurants'])
            ->name('top-restaurants');
        
        // Conversion Funnel
        Route::get('/conversion-funnel', [AnalyticsController::class, 'conversionFunnel'])
            ->name('conversion-funnel');
        
        // Real-time Analytics
        Route::get('/real-time', [AnalyticsController::class, 'realTimeAnalytics'])
            ->name('real-time');
        
        // Export Analytics
        Route::post('/export', [AnalyticsController::class, 'export'])
            ->name('export');
        
        // Download Report
        Route::get('/download/{report}', [AnalyticsController::class, 'download'])
            ->name('download');

        // Reports Management
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [AnalyticsReportController::class, 'index'])->name('index');
            Route::get('/{report}', [AnalyticsReportController::class, 'show'])->name('show');
            Route::delete('/{report}', [AnalyticsReportController::class, 'destroy'])->name('destroy');
        });
    });
});
