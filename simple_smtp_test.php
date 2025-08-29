<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "📧 Quick SMTP Test\n";
echo "=================\n\n";

// Check config
echo "MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
echo "MAIL_PORT: " . config('mail.mailers.smtp.port') . "\n";
echo "MAIL_USERNAME: " . config('mail.mailers.smtp.username') . "\n";
echo "MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption') . "\n";
echo "MAIL_FROM_ADDRESS: " . config('mail.from.address') . "\n\n";

try {
    
    echo "Attempting to send test email...\n";
    
    Mail::raw('This is a simple test from FOODLY', function($message) {
        $message->to('david.gakhokia@gmail.com')
               ->subject('🧪 Simple FOODLY Test')
               ->from('noreply@foodlyapp.ge', 'FOODLY Test');
    });
    
    echo "✅ SUCCESS: Test email sent!\n";
    
} catch (Exception $e) {
    echo "❌ FAILED: " . $e->getMessage() . "\n";
    echo "Error Class: " . get_class($e) . "\n";
}
