<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientConfirmedEmail;
use App\Mail\Restaurant\RestaurantConfirmedEmail;
use App\Mail\Admin\AdminConfirmedEmail;
use App\Models\Reservation;

echo "🎨 Testing All Three Email Designs\n";
echo "=================================\n\n";

try {
    // მოვძებნოთ ბოლო რეზერვაცია
    $reservation = Reservation::latest()->first();
    
    if (!$reservation) {
        echo "❌ No reservation found.\n";
        exit(1);
    }
    
    echo "📋 Using reservation:\n";
    echo "   ID: {$reservation->id}\n";
    echo "   Client: {$reservation->name}\n";
    echo "   Status: {$reservation->status}\n\n";
    
    // 1. CLIENT EMAIL - მხიარული დიზაინი
    echo "🌈 Sending CLIENT email (მხიარული დიზაინი)...\n";
    echo "   To: david.gakhokia@gmail.com\n";
    
    $clientMailable = new ClientConfirmedEmail($reservation);
    Mail::to('david.gakhokia@gmail.com')->send($clientMailable);

    echo "✅ Client email sent!\n\n";
    
    sleep(2); // Wait between emails
    
    // 2. RESTAURANT EMAIL - საქმიანი დიზაინი
    echo "🏢 Sending RESTAURANT email (საქმიანი დიზაინი)...\n";
    echo "   To: foodly.portal@gmail.com\n";
    
    $restaurantMailable = new RestaurantConfirmedEmail($reservation);
    Mail::to('foodly.portal@gmail.com')->send($restaurantMailable);
    
    echo "✅ Restaurant email sent!\n\n";
    
    sleep(2); // Wait between emails
    
    // 3. ADMIN EMAIL - დეტალური დიზაინი
    echo "📊 Sending ADMIN email (დეტალური დიზაინი)...\n";
    echo "   To: admin@foodlyapp.ge\n";
    
    $adminMailable = new AdminConfirmedEmail($reservation);
    Mail::to('admin@foodlyapp.ge')->send($adminMailable);
    
    echo "✅ Admin email sent!\n\n";
    
    echo "🎉 All three design tests completed!\n\n";
    echo "📧 Check these emails:\n";
    echo "   🌈 Client Design: gakhokia.david@gmail.com\n";
    echo "   🏢 Restaurant Design: foodly.portal@gmail.com\n";
    echo "   📊 Admin Design: admin@foodlyapp.ge\n\n";
    
    echo "💡 Each email has different style:\n";
    echo "   🌈 Client: მხიარული, ფერადი, emoji-ები\n";
    echo "   🏢 Restaurant: საქმიანი, პროფესიონალური\n";
    echo "   📊 Admin: დეტალური, ინფორმაციული\n\n";
    
    echo "🎯 If designs look good, we can update all email types!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Design comparison test completed!\n";
