<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Create a simple test to verify our changes work
$app = new Application(realpath(__DIR__));

echo "Testing notification system...\n";

// Simulate a reservation status change event
use App\Events\ReservationStatusChanged;
use App\Models\Reservation;

// Create a mock reservation
$mockReservation = (object) [
    'id' => 123,
    'status' => 'Confirmed',
    'email' => 'gakhokia.david@gmail.com',
    'name' => 'Test User',
    'restaurant' => (object) [
        'name' => 'Test Restaurant',
        'email' => 'dev.foodly@gmail.com',
        'admin_email' => 'admin@foodlyapp.ge'
    ]
];

echo "Mock reservation created.\n";

// Test ReservationStatusChanged event dispatch
try {
    $event = new ReservationStatusChanged($mockReservation, 'Pending', 'Confirmed');
    echo "Event created successfully.\n";
    echo "Old Status: " . $event->oldStatus . "\n";
    echo "New Status: " . $event->newStatus . "\n";
    echo "Reservation ID: " . $event->reservation->id . "\n";
} catch (Exception $e) {
    echo "Error creating event: " . $e->getMessage() . "\n";
}

echo "Test completed.\n";
