<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🎨 Testing PENDING Status Emails\n";
echo "================================\n\n";

// Recipients
$emails = [
    'client' => 'david.gakhokia@gmail.com',
    'admin' => 'admin@foodlyapp.ge', 
    'restaurant' => 'foodly.portal@gmail.com'
];

// Sample reservation data
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
    'restaurantPhone' => '+995322123456',
    'expectedRevenue' => 250,
    'estimatedDuration' => 2,
    'confirmUrl' => 'https://restaurant.foodly.space/confirm/12345',
    'rejectUrl' => 'https://restaurant.foodly.space/reject/12345',
    'adminPanelUrl' => 'https://admin.foodly.space/reservations',
    'restaurantPanelUrl' => 'https://restaurant.foodly.space/calendar'
];

foreach ($emails as $userType => $email) {
    try {
        $subject = "🍽️ FOODLY {$userType} - PENDING რეზერვაცია";
        $template = "emails.{$userType}.pending";
        
        Mail::send($template, $data, function($message) use ($email, $subject) {
            $message->to($email)
                   ->subject($subject)
                   ->from('noreply@foodlyapp.ge', 'FOODLY Platform');
        });
        
        echo "✅ PENDING {$userType} -> {$email}\n";
        sleep(2); // 2 second delay
        
    } catch (Exception $e) {
        echo "❌ {$userType} failed: " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 PENDING emails sent successfully!\n";
echo "📱 Check your inboxes for the new designs!\n";
