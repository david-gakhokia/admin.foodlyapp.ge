<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;

// Bootstrap Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Direct Email Sending\n";
echo "===============================\n\n";

// Test 1: Simple test email
echo "📧 Test 1: Sending simple test email...\n";

try {
    Mail::raw('ეს არის ტესტ იმეილი ფუდლი აპიდან! 🍕', function ($message) {
        $message->to('gakhokia.david@gmail.com')
                ->subject('🧪 ტესტ იმეილი - Foodly App');
    });
    
    echo "✅ Simple email sent successfully!\n\n";
} catch (Exception $e) {
    echo "❌ Failed to send simple email: " . $e->getMessage() . "\n\n";
}

// Test 2: Real reservation email template
echo "📧 Test 2: Sending reservation email template...\n";

try {
    // Create a fake reservation object for testing
    $fakeReservation = new stdClass();
    $fakeReservation->id = 999;
    $fakeReservation->name = 'ტესტ კლიენტი';
    $fakeReservation->phone = '+995555123456';
    $fakeReservation->email = 'gakhokia.david@gmail.com';
    $fakeReservation->status = 'Confirmed';
    $fakeReservation->reservation_date = now();
    $fakeReservation->time_from = '19:00';
    $fakeReservation->time_to = '21:00';
    $fakeReservation->guests_count = 4;
    $fakeReservation->notes = 'ტესტ შენიშვნები';
    $fakeReservation->created_at = now();
    
    // Mock getRestaurantName method
    $fakeReservation->getRestaurantName = function() {
        return 'ტესტ რესტორანი';
    };

    Mail::send('emails.client.confirmed', ['reservation' => $fakeReservation], function ($message) {
        $message->to('gakhokia.david@gmail.com')
                ->subject('🎉 რეზერვაცია დადასტურდა - Foodly App');
    });
    
    echo "✅ Template email sent successfully!\n\n";
} catch (Exception $e) {
    echo "❌ Failed to send template email: " . $e->getMessage() . "\n\n";
}

// Test 3: Check mail configuration
echo "🔧 Test 3: Checking mail configuration...\n";

try {
    $mailConfig = config('mail');
    echo "Mail Driver: " . $mailConfig['default'] . "\n";
    echo "SMTP Host: " . config('mail.mailers.smtp.host') . "\n";
    echo "SMTP Port: " . config('mail.mailers.smtp.port') . "\n";
    echo "From Address: " . config('mail.from.address') . "\n";
    echo "From Name: " . config('mail.from.name') . "\n\n";
} catch (Exception $e) {
    echo "❌ Error reading mail config: " . $e->getMessage() . "\n\n";
}

// Test 4: Check if we can create actual Reservation
echo "📊 Test 4: Testing database connection...\n";

try {
    $reservationCount = \DB::table('reservations')->count();
    echo "✅ Database connected. Total reservations: $reservationCount\n";
    
    // Get a real reservation if exists
    $realReservation = \DB::table('reservations')->first();
    if ($realReservation) {
        echo "📋 Found real reservation ID: {$realReservation->id}\n";
        echo "   Name: {$realReservation->name}\n";
        echo "   Status: {$realReservation->status}\n\n";
        
        // Test with real reservation
        echo "📧 Test 5: Sending email with real reservation...\n";
        
        try {
            Mail::send('emails.client.confirmed', ['reservation' => $realReservation], function ($message) use ($realReservation) {
                $message->to('gakhokia.david@gmail.com')
                        ->subject("🎉 რეალური რეზერვაცია #{$realReservation->id} - Foodly App");
            });
            
            echo "✅ Real reservation email sent successfully!\n\n";
        } catch (Exception $e) {
            echo "❌ Failed to send real reservation email: " . $e->getMessage() . "\n\n";
        }
    } else {
        echo "ℹ️ No reservations found in database\n\n";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n\n";
}

echo "🏁 Email testing completed!\n";
echo "============================================\n";
echo "💡 Check your email inbox: gakhokia.david@gmail.com\n";
echo "📝 If emails don't arrive, check:\n";
echo "   - .env file MAIL_ settings\n";
echo "   - SMTP credentials\n";
echo "   - Email spam folder\n";
