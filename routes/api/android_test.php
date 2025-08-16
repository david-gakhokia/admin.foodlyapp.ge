<?php

use Illuminate\Support\Facades\Route;

// Simple test route
Route::get('test', function () {
    return response()->json(['message' => 'Android API is working!']);
});
