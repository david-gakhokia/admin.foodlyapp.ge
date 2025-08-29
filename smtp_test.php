<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🔍 SMTP კავშირის ტესტი\n";
echo "=====================\n\n";

// Test specific email addresses one by one
$emails = [
    'david.gakhokia@gmail.com' => 'Gmail (Primary)',
    'gakhokia.david@gmail.com' => 'Gmail (Secondary)', 
    'dev.foodly@gmail.com' => 'Gmail (Dev)',
    'foodly.portal@gmail.com' => 'Gmail (Portal)',
    'admin@foodlyapp.ge' => 'Hostinger (Admin)'
];

echo "📧 SMTP კონფიგურაცია:\n";
echo "   Host: " . config('mail.mailers.smtp.host') . "\n";
echo "   Port: " . config('mail.mailers.smtp.port') . "\n";
echo "   Username: " . config('mail.mailers.smtp.username') . "\n";
echo "   Encryption: " . config('mail.mailers.smtp.encryption') . "\n";
echo "   From: " . config('mail.from.address') . "\n\n";

foreach ($emails as $email => $description) {
    echo "📮 ტესტირება: $email ($description)\n";
    
    try {
        $timestamp = now()->format('H:i:s');
        
        Mail::raw("ეს არის ტესტ შეტყობინება $email მისამართზე\n\nგაგზავნის დრო: $timestamp\nSMTP: " . config('mail.mailers.smtp.host'), function ($message) use ($email, $timestamp) {
            $message->to($email)
                    ->subject("🧪 SMTP ტესტი - $timestamp")
                    ->priority(1); // High priority
        });
        
        echo "   ✅ წარმატებით გაიგზავნა\n";
        
        // Check for any mail failures
        if (Mail::failures()) {
            echo "   ⚠️ SMTP Failures: " . implode(', ', Mail::failures()) . "\n";
        }
        
    } catch (Exception $e) {
        echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        
        // More detailed error info
        if (method_exists($e, 'getPrevious') && $e->getPrevious()) {
            echo "   🔍 დეტალები: " . $e->getPrevious()->getMessage() . "\n";
        }
    }
    
    echo "\n";
    
    // Small delay to avoid rate limiting
    sleep(1);
}

echo "💡 რჩევები foodly.portal@gmail.com-ისთვის:\n";
echo "========================================\n";
echo "1. 📧 შეამოწმეთ Spam/Junk folder\n";
echo "2. 🔍 შეამოწმეთ Gmail-ის Filters & Labels\n";
echo "3. 📱 შეამოწმეთ Mobile Gmail app-ში\n";
echo "4. ⚙️ შეამოწმეთ Gmail Settings > Forwarding and POP/IMAP\n";
echo "5. 🛡️ შეამოწმეთ Gmail Security settings\n";
echo "6. 📊 შეამოწმეთ Gmail Storage (თუ სავსეა)\n\n";

echo "🔧 SMTP Diagnostics:\n";
echo "====================\n";

try {
    // Test SMTP connection manually
    $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport(
        config('mail.mailers.smtp.host'),
        config('mail.mailers.smtp.port'),
        config('mail.mailers.smtp.encryption') === 'tls'
    );
    
    $transport->setUsername(config('mail.mailers.smtp.username'));
    $transport->setPassword(config('mail.mailers.smtp.password'));
    
    echo "✅ SMTP Transport created successfully\n";
    
} catch (Exception $e) {
    echo "❌ SMTP Transport error: " . $e->getMessage() . "\n";
}

echo "\n🎯 ტესტი დასრულდა!\n";
