<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

echo "📧 Simple Email Test (Log Mode)\n";
echo "===============================\n\n";

try {
    // ამჯერად log mode-ში ვიტესტავთ
    Config::set('mail.default', 'log');
    
    echo "📋 Testing with LOG driver (no actual email sent)\n";
    echo "This will show if email system works without SMTP issues\n\n";

    $testEmail = 'gakhokia.david@gmail.com';
    
    Mail::raw('🧪 ეს არის ტესტ ელფოსტა FOODLY-დან!

Email კონფიგურაცია მუშაობს სწორად! ✅

---
Test Email from FOODLY
Time: ' . now()->format('Y-m-d H:i:s'), function ($message) use ($testEmail) {
        $message->to($testEmail)
                ->subject('🧪 FOODLY Email Test (Log Mode)');
    });

    echo "✅ Email processed successfully!\n";
    echo "📝 Check storage/logs/laravel.log for email content\n\n";
    
    echo "🔍 Now testing with real SMTP...\n";
    
    // ახლა real SMTP-ით
    Config::set('mail.default', 'smtp');
    
    Mail::raw('🎉 ეს არის რეალური ელფოსტა FOODLY-დან!

თუ ეს წერილი მიიღე, SMTP კონფიგურაცია მუშაობს! ✅

---
FOODLY Real Email Test
Time: ' . now()->format('Y-m-d H:i:s'), function ($message) use ($testEmail) {
        $message->to($testEmail)
                ->subject('🍽️ FOODLY Real Email Test');
    });

    echo "✅ SMTP email sent successfully!\n";
    echo "📱 Check your email: {$testEmail}\n\n";
    
    echo "🎯 Email system is ready for reservations!\n";

} catch (Exception $e) {
    echo "❌ Email test failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    if (str_contains($e->getMessage(), 'Connection could not be established')) {
        echo "🔧 SMTP Connection Issue:\n";
        echo "1. Check firewall/antivirus\n";
        echo "2. Verify SMTP credentials\n";
        echo "3. Try different port (587 instead of 465)\n";
    }
    
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Email test completed!\n";
