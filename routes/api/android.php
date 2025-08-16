<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Android API Routes
|--------------------------------------------------------------------------
| 
| Android mobile app specific API endpoints with optimized responses
| for mobile performance and Android-specific features.
|
| Base URL: /api/android/
|
*/

// 📱 Test Route
Route::get('test', function () {
    return response()->json(['message' => 'Android API Working!', 'platform' => 'android']);
})->name('test');
