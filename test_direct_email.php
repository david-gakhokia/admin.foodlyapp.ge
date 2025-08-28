<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientConfirmedEmail;
use App\Models\Reservation;

try {
    $reservation = Reservation::find(3);
    
    if (!$reservation) {
        echo "Reservation not found\n";
        exit;
    }
    
    echo "Found reservation: " . $reservation->id . "\n";
    echo "Client: " . $reservation->client_name . "\n";
    echo "Status: " . $reservation->status . "\n";
    
    // Test mailable creation
    $mailable = new ClientConfirmedEmail($reservation);
    echo "Created mailable\n";
    
    // Test email sending
    $to = 'gakhokia.david@gmail.com';
    echo "Attempting to send email to: $to\n";
    
    Mail::to($to)->send($mailable);
    
    echo "✅ Email sent successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
