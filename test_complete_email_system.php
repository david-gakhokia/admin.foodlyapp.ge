<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🚀 FOODLY Email System - Complete Test\n";
echo "=====================================\n\n";

// Clear config cache first
echo "🔄 Clearing Laravel cache...\n";
\Illuminate\Support\Facades\Artisan::call('config:clear');
\Illuminate\Support\Facades\Artisan::call('cache:clear');
echo "✅ Cache cleared\n\n";

// Recipients
$emails = [
    'client' => 'david.gakhokia@gmail.com',
    'admin' => 'admin@foodlyapp.ge', 
    'restaurant' => 'foodly.portal@gmail.com'
];

$statuses = ['pending', 'confirmed', 'cancelled', 'paid'];

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

$totalSent = 0;
$totalFailed = 0;

foreach ($statuses as $status) {
    echo "📧 Sending {$status} emails...\n";
    echo str_repeat("-", 40) . "\n";
    
    foreach ($emails as $userType => $email) {
        try {
            $statusEmoji = [
                'pending' => '📋',
                'confirmed' => '✅', 
                'cancelled' => '❌',
                'paid' => '💳'
            ];
            
            $subject = "{$statusEmoji[$status]} FOODLY {$userType} - " . ucfirst($status) . " რეზერვაცია";
            $template = "emails.{$userType}.{$status}";
            
            echo "  🔄 Sending {$userType} ({$status}) to {$email}... ";
            
            Mail::send($template, $data, function($message) use ($email, $subject) {
                $message->to($email)
                       ->subject($subject)
                       ->from('noreply@foodlyapp.ge', 'FOODLY Platform');
            });
            
            echo "✅ SUCCESS\n";
            $totalSent++;
            
            sleep(1); // 1 second delay to avoid rate limiting
            
        } catch (Exception $e) {
            echo "❌ FAILED: " . $e->getMessage() . "\n";
            $totalFailed++;
        }
    }
    echo "\n";
}

echo "🎉 EMAIL SENDING SUMMARY\n";
echo "========================\n";
echo "✅ Successfully sent: {$totalSent} emails\n";
echo "❌ Failed: {$totalFailed} emails\n";
echo "📊 Total attempted: " . ($totalSent + $totalFailed) . " emails\n\n";

echo "📱 CHECK YOUR INBOXES:\n";
echo "- david.gakhokia@gmail.com (Client emails)\n";
echo "- admin@foodlyapp.ge (Admin emails)\n"; 
echo "- foodly.portal@gmail.com (Restaurant emails)\n\n";

echo "🎨 Each recipient should receive:\n";
foreach ($statuses as $status) {
    echo "  📧 {$status} email with unique design\n";
}

echo "\n✨ Look for emails from: noreply@foodlyapp.ge\n";
echo "📂 Check spam folders if emails don't appear\n\n";

if ($totalSent > 0) {
    echo "🎯 SUCCESS! New email system is working!\n";
} else {
    echo "⚠️  Check SMTP configuration or email template errors\n";
}
