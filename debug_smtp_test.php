<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

echo "🔍 Verbose SMTP Debug Test\n";
echo "=========================\n\n";

// Enable debug mode
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check mail config
$config = config('mail');
echo "📋 Mail Configuration:\n";
echo "Default Mailer: " . $config['default'] . "\n";
echo "SMTP Host: " . $config['mailers']['smtp']['host'] . "\n";
echo "SMTP Port: " . $config['mailers']['smtp']['port'] . "\n";
echo "SMTP Username: " . $config['mailers']['smtp']['username'] . "\n";
echo "SMTP Encryption: " . $config['mailers']['smtp']['encryption'] . "\n";
echo "From Address: " . $config['from']['address'] . "\n\n";

// Test connection first
echo "🔗 Testing SMTP connection...\n";

try {
    $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport(
        $config['mailers']['smtp']['host'],
        $config['mailers']['smtp']['port'],
        $config['mailers']['smtp']['encryption'] === 'ssl'
    );
    
    $transport->setUsername($config['mailers']['smtp']['username']);
    $transport->setPassword($config['mailers']['smtp']['password']);
    
    echo "✅ SMTP transport created successfully\n";
    
    // Now try sending email
    echo "\n📧 Attempting to send email...\n";
    
    Mail::raw('This is a debug test from FOODLY system', function($message) {
        $message->to('david.gakhokia@gmail.com')
               ->subject('🔍 FOODLY Debug Test - ' . date('Y-m-d H:i:s'))
               ->from('noreply@foodlyapp.ge', 'FOODLY Debug');
    });
    
    echo "✅ SUCCESS: Email sent successfully!\n";
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "Error Type: " . get_class($e) . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
}

// Check logs
echo "\n📄 Checking Laravel logs...\n";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $logs = file_get_contents($logFile);
    if (!empty($logs)) {
        echo "Recent logs:\n" . substr($logs, -1000) . "\n";
    } else {
        echo "No logs found\n";
    }
} else {
    echo "Log file does not exist\n";
}
