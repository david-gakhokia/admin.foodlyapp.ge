<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AdminConfirmedEmail;
use App\Models\Reservation;

echo "🎨 Testing New Email Design\n";
echo "===========================\n\n";

try {
    // მოვძებნოთ ბოლო რეზერვაცია
    $reservation = Reservation::latest()->first();
    
    if (!$reservation) {
        echo "❌ No reservation found.\n";
        exit(1);
    }
    
    echo "📋 Using reservation ID: {$reservation->id}\n";
    echo "👤 Client: {$reservation->name}\n";
    echo "📧 Email: {$reservation->email}\n\n";
    
    echo "🎨 Sending test email with new design...\n";
    
    $mailable = new AdminConfirmedEmail($reservation);
    
    Mail::to('david.gakhokia@gmail.com')->send($mailable);
    
    echo "✅ New design email sent!\n";
    echo "📱 Check your email for the updated design\n";
    echo "🎯 If you like it, we can update all templates!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Design test completed!\n";
