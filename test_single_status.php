<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

// Get status from command line argument
$status = $argv[1] ?? 'pending';

echo "🎨 Testing {$status} Status Emails\n";
echo str_repeat("=", 30) . "\n\n";

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
    'created_at' => '2025-08-29 18:30:00',
    'confirmed_at' => '2025-08-29 18:45:00',
    'cancelled_at' => '2025-08-29 19:00:00'
];

// Data for all email types
$data = [
    'reservation' => $reservation,
    'restaurantName' => 'Villa Vino',
    'restaurantPhone' => '+995322123456',
    'expectedRevenue' => 250,
    'lostRevenue' => 250,
    'paymentAmount' => 50,
    'transactionId' => 'TXN_20250829_12345',
    'paymentTime' => '2025-08-29 19:15:00',
    'platformFee' => 2.5,
    'restaurantShare' => 47.5,
    'commissionRate' => 5,
    'sharePercentage' => 95,
    'todayRevenue' => 1250,
    'todayPaidReservations' => 8,
    'todayTotalReservations' => 12,
    'todayConfirmed' => 10,
    'todayCancelled' => 2,
    'todayLostRevenue' => 500,
    'weeklyRevenue' => 8500,
    'successRate' => 95,
    'estimatedDuration' => 2,
    'confirmUrl' => 'https://restaurant.foodly.space/confirm/12345',
    'rejectUrl' => 'https://restaurant.foodly.space/reject/12345',
    'adminPanelUrl' => 'https://admin.foodly.space/reservations',
    'restaurantPanelUrl' => 'https://restaurant.foodly.space/calendar',
    'cancellationReason' => 'რესტორანში ტექნიკური პრობლემები'
];

$sent = 0;

foreach ($emails as $userType => $email) {
    try {
        $subject = "🍽️ FOODLY {$userType} - " . strtoupper($status);
        $template = "emails.{$userType}.{$status}";
        
        Mail::send($template, $data, function($message) use ($email, $subject) {
            $message->to($email)
                   ->subject($subject)
                   ->from('noreply@foodlyapp.ge', 'FOODLY Platform');
        });
        
        echo "✅ {$status} {$userType} -> {$email}\n";
        $sent++;
        
    } catch (Exception $e) {
        echo "❌ {$userType} failed: " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 {$status} emails: {$sent}/3 sent successfully!\n";
