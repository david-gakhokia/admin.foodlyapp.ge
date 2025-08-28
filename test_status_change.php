<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Reservation;
use App\Events\ReservationStatusChanged;

$reservation = Reservation::find(3);

if ($reservation) {
    $oldStatus = $reservation->status;
    $newStatus = 'Cancelled';  // Change to different status
    
    echo "Testing status change from '{$oldStatus}' to '{$newStatus}'\n";
    
    // Update the reservation
    $reservation->update([
        'status' => $newStatus,
        'updated_at' => now()
    ]);
    
    // Fire the event manually to test email system
    ReservationStatusChanged::dispatch($reservation, $oldStatus, $newStatus);
    
    echo "Event dispatched successfully!\n";
    echo "Check queue with: php artisan queue:work --once\n";
    
} else {
    echo "Reservation not found\n";
}
