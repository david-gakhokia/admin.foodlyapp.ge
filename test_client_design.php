<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\Client\ClientConfirmedEmail;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test reservation data
$reservationData = [
    'id' => 6,
    'name' => 'ნინო გელაშვილი', 
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995598123456',
    'reservation_date' => '2025-01-15',
    'time_from' => '19:00',
    'time_to' => '21:00',
    'guests_count' => 4,
    'status' => 'confirmed',
    'notes' => 'ვეგეტარიანული მენიუ სასურველია'
];

$reservation = (object) $reservationData;

echo "🎨 Testing Updated CLIENT Email Design\n";
echo "=====================================\n\n";

try {
    // Create and send client email
    $clientMail = new ClientConfirmedEmail($reservation, 'ჯადო რესტორანი');
    
    echo "📧 Sending CLIENT email to: {$reservation->email}\n";
    
    $result = Mail::to($reservation->email)->send($clientMail);
    
    echo "✅ CLIENT email sent successfully!\n";
    echo "📬 Check your email for the updated mobile-optimized design\n\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n\n";
}

echo "🔍 Checking queue status...\n";
echo "Queue jobs count: " . DB::table('jobs')->count() . "\n";
echo "Failed jobs count: " . DB::table('failed_jobs')->count() . "\n";

?>
