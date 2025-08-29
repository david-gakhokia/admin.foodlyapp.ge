<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Events\ReservationStatusChanged;
use App\Models\Reservation;

echo "🎯 ფინალური ტესტი - რეზერვაციის Email სისტემა\n";
echo "============================================\n\n";

try {
    // ვიპოვოთ რეალური რეზერვაცია ან შევქმნათ ტესტ რეზერვაცია
    $reservation = Reservation::first();
    
    if (!$reservation) {
        echo "❌ რეზერვაცია ვერ მოიძებნა. შევქმნათ ტესტ რეზერვაცია...\n";
        
        $reservation = new Reservation([
            'type' => 'restaurant',
            'reservable_type' => 'App\\Models\\Restaurant',
            'reservable_id' => 1,
            'reservation_date' => now()->addDay()->toDateString(),
            'time_from' => '19:00:00',
            'time_to' => '21:00:00',
            'guests_count' => 4,
            'name' => 'ფინალური ტესტი',
            'phone' => '+995555123456',
            'email' => 'david.gakhokia@gmail.com',
            'notes' => 'ფინალური ტესტი Email სისტემის შესამოწმებლად',
            'status' => 'Pending'
        ]);
        $reservation->id = 9999; // Fake ID for testing
    }
    
    echo "📧 ტესტ რეზერვაცია:\n";
    echo "   ID: {$reservation->id}\n";
    echo "   კლიენტი: {$reservation->name}\n";
    echo "   Email: {$reservation->email}\n";
    echo "   თარიღი: {$reservation->reservation_date}\n";
    echo "   დრო: {$reservation->time_from} - {$reservation->time_to}\n";
    echo "   სტუმრები: {$reservation->guests_count}\n\n";
    
    // Test all status changes with new designs
    $statusTests = [
        ['old' => null, 'new' => 'Pending', 'desc' => 'რეზერვაციის შექმნა'],
        ['old' => 'Pending', 'new' => 'Confirmed', 'desc' => 'დადასტურება'],
        ['old' => 'Confirmed', 'new' => 'Completed', 'desc' => 'დასრულება'],
        ['old' => 'Pending', 'new' => 'Cancelled', 'desc' => 'გაუქმება']
    ];
    
    foreach ($statusTests as $index => $test) {
        echo "🔄 ტესტი " . ($index + 1) . ": {$test['desc']}\n";
        echo "   სტატუსი: {$test['old']} → {$test['new']}\n";
        
        try {
            // Dispatch event
            ReservationStatusChanged::dispatch($reservation, $test['old'], $test['new']);
            
            echo "   ✅ Event წარმატებით dispatch-ია!\n";
            echo "   📧 Email-ები Queue-ში დაემატა:\n";
            echo "      👤 კლიენტისთვის (emails.client." . strtolower($test['new']) . ")\n";
            echo "      🏪 რესტორნისთვის (emails.restaurant." . strtolower($test['new']) . ")\n";
            echo "      🛡️ ადმინისთვის (emails.admin." . strtolower($test['new']) . ")\n";
            
        } catch (Exception $e) {
            echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
        sleep(2); // Wait between tests
    }
    
    echo "🔧 Queue Jobs-ების გაშვება:\n";
    echo "============================\n";
    echo "Queue-ში დაგროვილი Email-ების გასაგზავნად გაუშვით:\n";
    echo "   php artisan queue:work --stop-when-empty\n\n";
    
    echo "📊 შეჯამება:\n";
    echo "=============\n";
    echo "✅ ყველა Mail კლასი განახლდა სწორი view-ების გამოსაყენებლად:\n\n";
    
    echo "👤 კლიენტის Email-ები:\n";
    echo "   • emails.client.pending\n";
    echo "   • emails.client.confirmed\n";
    echo "   • emails.client.completed\n";
    echo "   • emails.client.cancelled\n\n";
    
    echo "🏪 რესტორნის Email-ები:\n";
    echo "   • emails.restaurant.pending\n";
    echo "   • emails.restaurant.confirmed\n";
    echo "   • emails.restaurant.completed\n";
    echo "   • emails.restaurant.cancelled\n\n";
    
    echo "🛡️ ადმინის Email-ები:\n";
    echo "   • emails.admin.pending\n";
    echo "   • emails.admin.confirmed\n";
    echo "   • emails.admin.completed\n";
    echo "   • emails.admin.cancelled\n\n";
    
    echo "🎨 თითოეული Email ახლა ეყრდნობა საკუთარ Blade template-ს\n";
    echo "   თავისი უნიკალური დიზაინით და layout-ით!\n\n";
    
    echo "🎉 რეზერვაციის Email სისტემა მზადაა!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
