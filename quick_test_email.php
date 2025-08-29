<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientConfirmedEmail;

// Test data for reservation
$testReservation = (object) [
    'id' => 12345,
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995599123456',
    'reservation_date' => '2025-08-30',
    'reservation_time' => '19:30',
    'guests_count' => 4,
    'status' => 'confirmed',
    'special_requests' => 'ტესტირება ახალი ბრენდული დიზაინისა',
    'created_at' => now(),
    'updated_at' => now(),
    'restaurant' => (object) [
        'name' => 'FOODLY Test Restaurant',
        'email' => 'foodly.portal@gmail.com',
        'phone' => '+995591234567',
        'address' => 'თბილისი, რუსთაველის გამზირი 123'
    ]
];

echo "🎨 FOODLY ბრენდული Client Email-ის ტესტი\n";
echo "======================================\n\n";

try {
    echo "📧 Client Confirmed Email-ის გაგზავნა...\n";
    echo "მიმღები: david.gakhokia@gmail.com\n";
    echo "ტემპლეტი: emails.layouts.client\n\n";
    
    $clientMail = new ClientConfirmedEmail($testReservation);
    Mail::to('david.gakhokia@gmail.com')->send($clientMail);
    
    echo "✅ Email წარმატებით გაიგზავნა!\n\n";
    echo "🎨 ახალი ბრენდული ფერები გამოყენებულია:\n";
    echo "- Header: ნარინჯისფერი gradient (#ff6b35 → #f7931e)\n";
    echo "- Status Badge: ნარინჯისფერი accent\n";
    echo "- Message Box: ბრენდული ფერებით\n";
    echo "- Footer Links: ნარინჯისფერი\n\n";
    echo "📧 შეამოწმეთ david.gakhokia@gmail.com ინბოქსი!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
