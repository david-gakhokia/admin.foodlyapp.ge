<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Mail\Client\ClientPendingEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Admin\AdminPendingEmail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

echo "📧 პირდაპირი Email ტესტი\n";
echo "========================\n\n";

try {
    // ვნახოთ არსებული რეზერვაცია
    $reservation = Reservation::with('reservable')->first();
    
    if (!$reservation) {
        echo "❌ რეზერვაცია ვერ მოიძებნა\n";
        exit;
    }
    
    echo "🎯 რეზერვაცია: #{$reservation->id}\n";
    echo "👤 კლიენტი: {$reservation->name}\n";
    echo "📧 Email: {$reservation->email}\n\n";
    
    // Test 1: Client Email
    echo "📨 1. კლიენტის Email...\n";
    $clientMail = new ClientPendingEmail($reservation);
    Mail::to('david.gakhokia@gmail.com')->send($clientMail);
    echo "✅ კლიენტის Email გაიგზავნა!\n\n";
    
    sleep(1);
    
    // Test 2: Restaurant Email
    echo "🏪 2. რესტორნის Email...\n";
    $restaurantMail = new RestauranPendingEmail($reservation);
    Mail::to('foodly.portal@gmail.com')->send($restaurantMail);
    echo "✅ რესტორნის Email გაიგზავნა!\n\n";
    
    sleep(1);
    
    // Test 3: Admin Email
    echo "🛡️ 3. ადმინის Email...\n";
    $adminMail = new AdminPendingEmail($reservation);
    Mail::to('admin@foodlyapp.ge')->send($adminMail);
    echo "✅ ადმინის Email გაიგზავნა!\n\n";
    
    echo "🎉 ყველა Email წარმატებით გაიგზავნა!\n";
    echo "📬 შეამოწმეთ Email inbox-ები:\n";
    echo "   - david.gakhokia@gmail.com (კლიენტი)\n";
    echo "   - foodly.portal@gmail.com (რესტორანი)\n";
    echo "   - admin@foodlyapp.ge (ადმინი)\n\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
