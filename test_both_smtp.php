<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🧪 Testing Gmail SMTP (backup option)\n";
echo "===================================\n\n";

// Temporarily set Gmail config for testing
config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
config(['mail.mailers.smtp.port' => 587]);
config(['mail.mailers.smtp.encryption' => 'tls']);
config(['mail.mailers.smtp.username' => 'noreply@foodlyapp.ge']);
config(['mail.mailers.smtp.password' => 'Paroli_321!']);

echo "Testing with Gmail SMTP...\n";

try {
    Mail::raw('🍽️ Test from FOODLY via Gmail', function($message) {
        $message->to('david.gakhokia@gmail.com')
               ->subject('🧪 FOODLY Gmail Test')
               ->from('noreply@foodlyapp.ge', 'FOODLY Test');
    });
    
    echo "✅ SUCCESS: Gmail SMTP works!\n";
    
} catch (Exception $e) {
    echo "❌ Gmail FAILED: " . $e->getMessage() . "\n";
    
    // Try original Hostinger again
    echo "\nRetesting Hostinger SMTP...\n";
    config(['mail.mailers.smtp.host' => 'smtp.hostinger.com']);
    
    try {
        Mail::raw('🍽️ Test from FOODLY via Hostinger', function($message) {
            $message->to('david.gakhokia@gmail.com')
                   ->subject('🧪 FOODLY Hostinger Test')
                   ->from('noreply@foodlyapp.ge', 'FOODLY Test');
        });
        
        echo "✅ SUCCESS: Hostinger SMTP works!\n";
        
    } catch (Exception $e2) {
        echo "❌ Hostinger ALSO FAILED: " . $e2->getMessage() . "\n";
    }
}
