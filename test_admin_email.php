<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AdminConfirmedEmail;
use App\Models\Reservation;

try {
    $reservation = Reservation::find(3);
    
    if (!$reservation) {
        echo "Reservation not found\n";
        exit;
    }
    
    echo "Testing Admin Email...\n";
    echo "Found reservation: " . $reservation->id . "\n";
    
    // Test mailable creation
    $mailable = new AdminConfirmedEmail($reservation);
    echo "Created admin mailable\n";
    
    // Test email sending
    $to = 'admin@foodlyapp.ge';
    echo "Attempting to send admin email to: $to\n";
    
    Mail::to($to)->send($mailable);
    
    echo "✅ Admin email sent successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    if ($e->getPrevious()) {
        echo "Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
}
