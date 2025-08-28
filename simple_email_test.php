<?php

// Simple email test using Laravel Tinker commands

echo "Testing email with Laravel...\n";

// Test 1: Simple email
try {
    \Illuminate\Support\Facades\Mail::raw('ეს არის ტესტ იმეილი! 🎉', function ($message) {
        $message->to('gakhokia.david@gmail.com')
                ->subject('ტესტ იმეილი - Foodly App');
    });
    echo "✅ Simple email sent!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "Done.\n";
