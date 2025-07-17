<?php

// Laravel Tinker Test Script
// Run: php artisan tinker
// Then copy-paste these commands

use Illuminate\Support\Facades\Http;

// Test configuration
$baseUrl = config('app.url') . '/api/kiosk';
$token = 'your_kiosk_token_here'; // Replace with actual token
$restaurantSlug = 'georgian-house';
$placeSlug = 'summer-terrace';
$date = '2025-07-20';
$time = '18:30';

// Helper function
function kioskRequest($endpoint, $token) {
    return Http::withHeaders([
        'Authorization' => "Bearer $token",
        'Accept' => 'application/json'
    ])->get($endpoint);
}

// 1. Test Tables Overview
echo "1. Testing Tables Overview...\n";
$response1 = kioskRequest("$baseUrl/availability/restaurant/$restaurantSlug/tables-overview?date=$date", $token);
echo "Status: " . $response1->status() . "\n";
echo "Response: " . $response1->body() . "\n\n";

// 2. Test Available Times
echo "2. Testing Available Times...\n";
$response2 = kioskRequest("$baseUrl/availability/restaurant/$restaurantSlug/times?date=$date", $token);
echo "Status: " . $response2->status() . "\n";
echo "Response: " . $response2->body() . "\n\n";

// 3. Test Tables by Time (All Places)
echo "3. Testing Tables by Time (All Places)...\n";
$response3 = kioskRequest("$baseUrl/availability/restaurant/$restaurantSlug/tables-by-time?date=$date&time=$time", $token);
echo "Status: " . $response3->status() . "\n";
echo "Response: " . $response3->body() . "\n\n";

// 4. Test Tables by Time (Place Specific) - NEW ENDPOINT
echo "4. Testing Tables by Time (Place Specific) - NEW...\n";
$response4 = kioskRequest("$baseUrl/availability/restaurant/$restaurantSlug/$placeSlug/tables-by-time?date=$date&time=$time", $token);
echo "Status: " . $response4->status() . "\n";
echo "Response: " . $response4->body() . "\n\n";

echo "✅ All tests completed!\n";
