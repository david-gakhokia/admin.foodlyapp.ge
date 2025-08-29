<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "📧 Testing noreply@foodlyapp.ge SMTP Configuration\n";
echo "================================================\n\n";

// Test emails
$testEmails = [
    'david.gakhokia@gmail.com',
    'admin@foodlyapp.ge',
    'foodly.portal@gmail.com'
];

foreach ($testEmails as $email) {
    try {
        Mail::raw('🎉 Test email from noreply@foodlyapp.ge - SMTP Configuration Success!', function($message) use ($email) {
            $message->to($email)
                   ->subject('🍽️ FOODLY SMTP Test - New Email System')
                   ->from('noreply@foodlyapp.ge', 'FOODLY Platform');
        });
        
        echo "✅ Test email sent to: {$email}\n";
        sleep(2);
        
    } catch (Exception $e) {
        echo "❌ Failed to send to {$email}: " . $e->getMessage() . "\n";
    }
}

echo "\n🎯 If emails sent successfully, SMTP is configured correctly!\n";
echo "📱 Check inboxes (including spam folders)\n";
