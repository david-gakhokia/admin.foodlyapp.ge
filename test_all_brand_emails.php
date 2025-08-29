<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientPendingEmail;
use App\Mail\Client\ClientConfirmedEmail;
use App\Mail\Client\ClientCompletedEmail;
use App\Mail\Client\ClientCancelledEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Restaurant\RestaurantConfirmedEmail;
use App\Mail\Restaurant\RestaurantCompletedEmail;
use App\Mail\Restaurant\RestaurantCancelledEmail;
use App\Mail\Admin\AdminPendingEmail;
use App\Mail\Admin\AdminConfirmedEmail;
use App\Mail\Admin\AdminCompletedEmail;
use App\Mail\Admin\AdminCancelledEmail;

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

echo "🔄 FOODLY ყველა Email Template-ის ტესტირება\n";
echo "==========================================\n\n";

$emails = [
    // Client Emails
    ['type' => 'Client', 'status' => 'Pending', 'class' => ClientPendingEmail::class, 'to' => 'david.gakhokia@gmail.com'],
    ['type' => 'Client', 'status' => 'Confirmed', 'class' => ClientConfirmedEmail::class, 'to' => 'david.gakhokia@gmail.com'],
    ['type' => 'Client', 'status' => 'Completed', 'class' => ClientCompletedEmail::class, 'to' => 'david.gakhokia@gmail.com'],
    ['type' => 'Client', 'status' => 'Cancelled', 'class' => ClientCancelledEmail::class, 'to' => 'david.gakhokia@gmail.com'],
    
    // Restaurant Emails
    ['type' => 'Restaurant', 'status' => 'Pending', 'class' => RestauranPendingEmail::class, 'to' => 'foodly.portal@gmail.com'],
    ['type' => 'Restaurant', 'status' => 'Confirmed', 'class' => RestaurantConfirmedEmail::class, 'to' => 'foodly.portal@gmail.com'],
    ['type' => 'Restaurant', 'status' => 'Completed', 'class' => RestaurantCompletedEmail::class, 'to' => 'foodly.portal@gmail.com'],
    ['type' => 'Restaurant', 'status' => 'Cancelled', 'class' => RestaurantCancelledEmail::class, 'to' => 'foodly.portal@gmail.com'],
    
    // Admin Emails
    ['type' => 'Admin', 'status' => 'Pending', 'class' => AdminPendingEmail::class, 'to' => 'admin@foodlyapp.ge'],
    ['type' => 'Admin', 'status' => 'Confirmed', 'class' => AdminConfirmedEmail::class, 'to' => 'admin@foodlyapp.ge'],
    ['type' => 'Admin', 'status' => 'Completed', 'class' => AdminCompletedEmail::class, 'to' => 'admin@foodlyapp.ge'],
    ['type' => 'Admin', 'status' => 'Cancelled', 'class' => AdminCancelledEmail::class, 'to' => 'admin@foodlyapp.ge'],
];

$successCount = 0;
$totalCount = count($emails);

foreach ($emails as $emailConfig) {
    try {
        echo "📧 {$emailConfig['type']} - {$emailConfig['status']} → {$emailConfig['to']}\n";
        
        // Update reservation status for testing
        $testReservation->status = strtolower($emailConfig['status']);
        
        $mailClass = $emailConfig['class'];
        $mail = new $mailClass($testReservation);
        
        Mail::to($emailConfig['to'])->send($mail);
        
        echo "   ✅ გაიგზავნა წარმატებით!\n";
        $successCount++;
        
        // Small delay to prevent overwhelming the mail server
        usleep(500000); // 0.5 seconds
        
    } catch (Exception $e) {
        echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo "==========================================\n";
echo "🎯 შედეგები: {$successCount}/{$totalCount} Email გაიგზავნა\n\n";

if ($successCount === $totalCount) {
    echo "🎉 ყველა Email წარმატებით გაიგზავნა!\n\n";
    echo "✅ განახლებული ლეიაუტები:\n";
    echo "- Client emails → emails.layouts.client\n";
    echo "- Restaurant emails → emails.layouts.restaurant\n";
    echo "- Admin emails → emails.layouts.admin\n\n";
    echo "🎨 ყველა Email ახლა იყენებს FOODLY-ს ბრენდულ ფერებს:\n";
    echo "- Primary Orange: #ff6b35\n";
    echo "- Secondary Orange: #f7931e\n";
    echo "- Success Green: #22c55e\n";
    echo "- Error Red: #ef4444\n\n";
    echo "📬 შეამოწმეთ ინბოქსები:\n";
    echo "- david.gakhokia@gmail.com (4 client emails)\n";
    echo "- foodly.portal@gmail.com (4 restaurant emails)\n";
    echo "- admin@foodlyapp.ge (4 admin emails)\n";
} else {
    echo "⚠️ ზოგიერთი Email ვერ გაიგზავნა. შეამოწმეთ კონფიგურაცია.\n";
}
