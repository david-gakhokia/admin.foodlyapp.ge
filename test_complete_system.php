<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🎨 Testing New Email Design System\n";
echo "==================================\n\n";

// Test recipients
$emails = [
    'client' => 'david.gakhokia@gmail.com',
    'admin' => 'admin@foodlyapp.ge', 
    'restaurant' => 'foodly.portal@gmail.com'
];

$statuses = ['pending', 'confirmed', 'cancelled', 'paid'];

// Sample data
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

foreach ($statuses as $status) {
    echo "📧 Sending {$status} emails...\n";
    
    foreach ($emails as $userType => $email) {
        try {
            $subject = "🍽️ FOODLY {$userType} - " . ucfirst($status);
            $template = "emails.{$userType}.{$status}";
            
            Mail::send($template, $data, function($message) use ($email, $subject) {
                $message->to($email)
                       ->subject($subject)
                       ->from('noreply@foodlyapp.ge', 'FOODLY');
            });
            
            echo "  ✅ {$userType} -> {$email}\n";
            $totalSent++;
            
            sleep(1); // 1 second delay
            
        } catch (Exception $e) {
            echo "  ❌ {$userType} failed: " . $e->getMessage() . "\n";
        }
    }
    echo "\n";
}

echo "🎉 Complete! Sent {$totalSent} emails total\n";
echo "📱 Check inboxes:\n";
echo "   • david.gakhokia@gmail.com (Client)\n";
echo "   • admin@foodlyapp.ge (Admin)\n"; 
echo "   • foodly.portal@gmail.com (Restaurant)\n\n";
echo "✨ Each should receive 4 emails with different designs!\n";
