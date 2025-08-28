<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AdminCancelledEmail;
use App\Models\Reservation;

try {
    $reservation = Reservation::find(3);
    
    if (!$reservation) {
        echo "Reservation not found\n";
        exit;
    }
    
    echo "Testing Admin Cancelled Email...\n";
    
    // Test mailable creation
    $mailable = new AdminCancelledEmail($reservation);
    echo "Created admin cancelled mailable\n";
    
    // Test email sending
    $to = 'admin@foodlyapp.ge';
    echo "Attempting to send admin cancelled email to: $to\n";
    
    Mail::to($to)->send($mailable);
    
    echo "✅ Admin cancelled email sent successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    if ($e->getPrevious()) {
        echo "Previous: " . $e->getPrevious()->getMessage() . "\n";
    }
}
