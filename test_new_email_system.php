<?php

require_once 'vendor/autoload.php';

use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientReservationEmail;
use App\Mail\AdminReservationEmail;
use App\Mail\RestaurantReservationEmail;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🎨 Testing New Email Design System\n";
echo "==================================\n\n";

// Test data
$testEmails = [
    'client' => 'david.gakhokia@gmail.com',
    'admin' => 'admin@foodlyapp.ge',
    'restaurant' => 'foodly.portal@gmail.com'
];

$statuses = ['pending', 'confirmed', 'cancelled', 'paid'];

// Sample reservation data
$reservationData = [
    'id' => 12345,
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995555123456',
    'guests_count' => 4,
    'reservation_date' => '2025-08-30',
    'time_from' => '19:00',
    'time_to' => '21:00',
    'notes' => 'საქორწილო ზეიმი - ყავისფერი მაგიდა სჭირდება',
    'created_at' => now(),
    'confirmed_at' => now()->addMinutes(15),
    'cancelled_at' => now()->addMinutes(30),
];

// Additional data for each email type
$additionalData = [
    'restaurantName' => 'Villa Vino',
    'restaurantPhone' => '+995322123456',
    'expectedRevenue' => 250,
    'lostRevenue' => 250,
    'paymentAmount' => 50,
    'transactionId' => 'TXN_' . time(),
    'paymentTime' => now(),
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

$totalEmails = 0;

foreach ($statuses as $status) {
    echo "📧 Testing status: " . strtoupper($status) . "\n";
    echo str_repeat("-", 40) . "\n";
    
    // Create reservation object
    $reservation = (object) array_merge($reservationData, ['status' => $status]);
    
    foreach ($testEmails as $userType => $email) {
        try {
            $template = "emails.{$userType}.{$status}";
            $subject = "🍽️ FOODLY - " . ucfirst($userType) . " " . ucfirst($status) . " Notification";
            
            // Prepare data for the email
            $emailData = array_merge($additionalData, [
                'reservation' => $reservation,
                'userType' => $userType,
                'status' => $status
            ]);
            
            // Send email using Laravel's mail system
            Mail::send($template, $emailData, function ($message) use ($email, $subject) {
                $message->to($email)
                        ->subject($subject)
                        ->from('noreply@foodlyapp.ge', 'FOODLY Platform');
            });
            
            echo "  ✅ {$userType} ({$status}) -> {$email}\n";
            $totalEmails++;
            
            // Small delay to avoid rate limiting
            usleep(500000); // 0.5 seconds
            
        } catch (Exception $e) {
            echo "  ❌ Error sending {$userType} ({$status}): " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n";
}

echo "🎉 Test Summary:\n";
echo "===============\n";
echo "📧 Total emails sent: {$totalEmails}\n";
echo "👥 Recipients:\n";
echo "   📱 Client: {$testEmails['client']}\n";
echo "   👨‍💼 Admin: {$testEmails['admin']}\n";
echo "   🏪 Restaurant: {$testEmails['restaurant']}\n\n";

echo "📋 Email Types Tested:\n";
foreach ($statuses as $status) {
    echo "   🔸 " . ucfirst($status) . " - 3 emails (client, admin, restaurant)\n";
}

echo "\n🎯 Expected Results:\n";
echo "   • Each recipient should receive 4 emails\n";
echo "   • Each email should have different design based on user type\n";
echo "   • Status-specific content and colors should be applied\n";
echo "   • Georgian text should display correctly\n";
echo "   • All links and buttons should be functional\n\n";

echo "✨ Please check your email inboxes!\n";
echo "📱 Check spam folders if emails don't appear in inbox\n";
