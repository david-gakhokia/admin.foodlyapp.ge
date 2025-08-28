<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Reservation;

$reservation = Reservation::find(3);

if ($reservation) {
    echo "Reservation ID: " . $reservation->id . "\n";
    echo "Status: " . $reservation->status . "\n";
    echo "Client: " . $reservation->client_name . "\n";
    
    $restaurant = $reservation->getRestaurant();
    
    if ($restaurant) {
        echo "Restaurant: " . $restaurant->name . "\n";
        echo "Restaurant ID: " . $restaurant->id . "\n";
        
        // Check for email
        if (isset($restaurant->email) && !empty($restaurant->email)) {
            echo "Restaurant Email: " . $restaurant->email . "\n";
        } else {
            echo "No restaurant email\n";
        }
        
        // Check for manager email
        if (isset($restaurant->manager_email)) {
            echo "Manager Email: " . $restaurant->manager_email . "\n";
        } else {
            echo "No manager_email field\n";
        }
        
        // Check for admin_email
        if (isset($restaurant->admin_email)) {
            echo "Admin Email: " . $restaurant->admin_email . "\n";
        } else {
            echo "No admin_email field\n";
        }
        
    } else {
        echo "No restaurant found\n";
    }
} else {
    echo "Reservation not found\n";
}
