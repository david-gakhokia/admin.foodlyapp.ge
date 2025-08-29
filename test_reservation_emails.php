<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Restaurant;
use App\Services\Reservation\ReservationService;

echo "🧪 ტესტირება: რეზერვაციის შექმნისას Email შეტყობინებები\n";
echo "==========================================================\n\n";

try {
    // ვიპოვოთ ტესტ რესტორანი
    $restaurant = Restaurant::where('status', 'active')->first();
    
    if (!$restaurant) {
        echo "❌ ვერ მოიძებნა აქტიური რესტორანი\n";
        exit;
    }
    
    echo "🏪 რესტორანი: {$restaurant->name}\n";
    echo "📧 რესტორნის Email: " . ($restaurant->email ?? 'N/A') . "\n\n";
    
    // ტესტ რეზერვაციის მონაცემები
    $customerData = [
        'name' => 'დავით გახოკია (ტესტი)',
        'phone' => '+995555123456',
        'email' => 'david.gakhokia@gmail.com',
        'notes' => 'ტესტ რეზერვაცია Email-ების შესამოწმებლად'
    ];
    
    echo "👤 კლიენტი: {$customerData['name']}\n";
    echo "📧 კლიენტის Email: {$customerData['email']}\n";
    echo "📅 რეზერვაციის თარიღი: " . now()->addDay()->toDateString() . "\n";
    echo "⏰ დრო: 19:00\n";
    echo "👥 სტუმრები: 4\n\n";
    
    // რეზერვაციის სერვისის გამოყენება
    $reservationService = new ReservationService();
    
    echo "🚀 რეზერვაციის შექმნა...\n";
    
    $reservation = $reservationService->createReservation(
        $restaurant,
        now()->addDay()->toDateString(),
        '19:00',
        4,
        $customerData
    );
    
    echo "✅ რეზერვაცია წარმატებით შეიქმნა!\n";
    echo "🆔 რეზერვაციის ID: {$reservation->id}\n";
    echo "📊 სტატუსი: {$reservation->status}\n\n";
    
    echo "📧 გაიგზავნა შეტყობინებები:\n";
    echo "   ✉️  კლიენტისთვის (Pending notification)\n";
    echo "   ✉️  რესტორნისთვის (New reservation alert)\n";
    echo "   ✉️  ადმინისთვის (Admin notification)\n\n";
    
    echo "🔍 შეამოწმეთ:\n";
    echo "   1. Email inbox-ები\n";
    echo "   2. Queue jobs: php artisan queue:work\n";
    echo "   3. Laravel logs: storage/logs/laravel.log\n\n";
    
    echo "💡 რეზერვაციის დეტალების ნახვა:\n";
    echo "   Admin Panel > Restaurants > {$restaurant->name} > Reservations > #{$reservation->id}\n\n";
    
    echo "🎉 ტესტი წარმატებით დასრულდა!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "📚 Stack trace:\n" . $e->getTraceAsString() . "\n";
}
