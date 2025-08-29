<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Events\ReservationStatusChanged;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

echo "🧪 მარტივი Email ტესტი\n";
echo "=====================\n\n";

try {
    // ვნახოთ არსებული რეზერვაცია
    $reservation = Reservation::first();
    
    if (!$reservation) {
        echo "❌ რეზერვაცია ვერ მოიძებნა. შევქმნათ ტესტ რეზერვაცია...\n";
        
        // Create test reservation using factory or direct creation
        $reservation = new Reservation([
            'type' => 'restaurant',
            'reservable_type' => 'App\\Models\\Restaurant',
            'reservable_id' => 1,
            'reservation_date' => now()->addDay()->toDateString(),
            'time_from' => '19:00:00',
            'time_to' => '21:00:00',
            'guests_count' => 4,
            'name' => 'ტესტ კლიენტი',
            'phone' => '+995555123456',
            'email' => 'david.gakhokia@gmail.com',
            'notes' => 'ტესტ რეზერვაცია Email-ების შესამოწმებლად',
            'status' => 'Pending'
        ]);
        $reservation->id = 999; // Fake ID for testing
    }
    
    echo "📧 Email Event-ის dispatch...\n";
    echo "რეზერვაცია ID: {$reservation->id}\n";
    echo "კლიენტი: {$reservation->name}\n";
    echo "Email: {$reservation->email}\n\n";
    
    // Test the event system
    ReservationStatusChanged::dispatch($reservation, null, 'Pending');
    
    echo "✅ Event წარმატებით dispatch-ია!\n\n";
    
    echo "🔍 შეამოწმეთ:\n";
    echo "   1. Laravel logs (storage/logs/laravel.log)\n";
    echo "   2. Queue jobs table: SELECT * FROM jobs;\n";
    echo "   3. Email inbox (david.gakhokia@gmail.com)\n\n";
    
    // Also test direct email sending
    echo "📮 ტესტ Email პირდაპირ...\n";
    
    Mail::raw('ეს არის ტესტ შეტყობინება Foodly App-იდან! 🎉', function ($message) {
        $message->to('david.gakhokia@gmail.com')
                ->subject('🧪 Foodly Test Email - ' . now()->format('H:i:s'));
    });
    
    echo "✅ ტესტ Email გაიგზავნა!\n\n";
    
    echo "⚡ Queue Job-ების გაშვება:\n";
    echo "   php artisan queue:work --stop-when-empty\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "📚 Stack trace:\n" . $e->getTraceAsString() . "\n";
}
