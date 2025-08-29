<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🚀 Testing PENDING Status Only\n";
echo "==============================\n\n";

$emails = [
    'david.gakhokia@gmail.com' => 'Client',
    'admin@foodlyapp.ge' => 'Admin',
    'foodly.portal@gmail.com' => 'Restaurant'
];

$reservation = (object) [
    'id' => 12345,
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995555123456',
    'guests_count' => 4,
    'reservation_date' => '2025-08-30',
    'time_from' => '19:00',
    'time_to' => '21:00',
    'notes' => 'საქორწილო ზეიმი - ყავისფერი მაგიდა სჭირდება',
    'created_at' => '2025-08-29 18:30:00'
];

$data = [
    'reservation' => $reservation,
    'restaurantName' => 'Villa Vino',
    'expectedRevenue' => 250,
    'estimatedDuration' => 2,
    'confirmUrl' => 'https://restaurant.foodly.space/confirm/12345',
    'rejectUrl' => 'https://restaurant.foodly.space/reject/12345',
    'adminPanelUrl' => 'https://admin.foodly.space/reservations'
];

$userTypes = ['client', 'admin', 'restaurant'];
$sent = 0;

foreach ($userTypes as $i => $userType) {
    $email = array_keys($emails)[$i];
    $type = $emails[$email];
    
    try {
        echo "📧 Sending PENDING {$type} email to {$email}... ";
        
        Mail::send("emails.{$userType}.pending", $data, function($message) use ($email, $type) {
            $message->to($email)
                   ->subject("📋 FOODLY {$type} - PENDING რეზერვაცია")
                   ->from('noreply@foodlyapp.ge', 'FOODLY');
        });
        
        echo "✅ SUCCESS!\n";
        $sent++;
        sleep(2);
        
    } catch (Exception $e) {
        echo "❌ FAILED: " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 PENDING Test Complete: {$sent}/3 emails sent\n";
echo "📱 Check your emails from: noreply@foodlyapp.ge\n";
