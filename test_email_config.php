<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

echo "📧 Testing Email Configuration\n";
echo "=============================\n\n";

try {
    // მოდი შევამოწმოთ მეილის კონფიგურაცია
    echo "📋 Current mail configuration:\n";
    echo "MAIL_MAILER: " . config('mail.default') . "\n";
    echo "MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
    echo "MAIL_PORT: " . config('mail.mailers.smtp.port') . "\n";
    echo "MAIL_USERNAME: " . config('mail.mailers.smtp.username') . "\n";
    echo "MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption') . "\n";
    echo "MAIL_FROM_ADDRESS: " . config('mail.from.address') . "\n";
    echo "MAIL_FROM_NAME: " . config('mail.from.name') . "\n\n";

    // შექმნათ test email
    echo "📧 Sending test email...\n";
    
    $testEmail = 'gakhokia.david@gmail.com'; // შენი email
    
    Mail::raw('🎉 ეს არის ტესტ ელფოსტა FOODLY-დან!

ეს ელფოსტა გაგზავნილია email კონფიგურაციის შესამოწმებლად.

თუ ეს წერილი მიიღე, ყველაფერი სწორად მუშაობს! ✅

---
FOODLY Email System Test
გზავნის დრო: ' . now()->format('Y-m-d H:i:s'), function ($message) use ($testEmail) {
        $message->to($testEmail)
                ->subject('🧪 FOODLY Email Test - ' . now()->format('H:i:s'));
    });

    echo "✅ Test email sent successfully to: {$testEmail}\n";
    echo "📱 Check your inbox (and spam folder)\n\n";
    
    echo "🔍 Testing with different recipient...\n";
    
    // კიდევ ერთი ტესტი nino@test.com-ზე (ჩვენი ტესტ email)
    $testEmail2 = 'nino@test.com';
    
    Mail::raw('📧 FOODLY რეზერვაციის ტესტი

ძვირფასო ნინო,

ეს არის ტესტ ელფოსტა რეზერვაციის სისტემის შესამოწმებლად.

თუ ეს წერილი მიიღე, email notifications მუშაობს! ✅

---
FOODLY Reservation System', function ($message) use ($testEmail2) {
        $message->to($testEmail2)
                ->subject('🍽️ FOODLY - ტესტ რეზერვაცია');
    });

    echo "✅ Test email also sent to: {$testEmail2}\n\n";
    
    echo "🎯 Results:\n";
    echo "✅ Email configuration is working\n";
    echo "✅ SMTP connection successful\n";
    echo "✅ Ready for reservation notifications\n\n";
    
    echo "📝 Next: Check your email and then run reservation test\n";

} catch (Exception $e) {
    echo "❌ Email test failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    echo "🔧 Common fixes:\n";
    echo "1. Check .env MAIL_* settings\n";
    echo "2. Verify SMTP credentials\n";
    echo "3. Check firewall/antivirus blocking\n";
    echo "4. Try different SMTP settings\n\n";
    
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Email test completed!\n";
