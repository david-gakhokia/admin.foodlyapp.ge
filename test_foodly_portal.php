<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🎯 foodly.portal@gmail.com ფოკუსირებული ტესტი\n";
echo "==============================================\n\n";

$targetEmail = 'foodly.portal@gmail.com';
$testEmails = [
    'david.gakhokia@gmail.com', // ეს მუშაობს
    $targetEmail  // ეს ვამოწმებთ
];

// Test different subject lines and content to avoid spam filters
$testCases = [
    [
        'subject' => 'Foodly Reservation System Test',
        'content' => 'Hello! This is a test email from Foodly reservation system.',
        'type' => 'English Simple'
    ],
    [
        'subject' => 'ფუდლი - რეზერვაციის ტესტი',
        'content' => 'გამარჯობა! ეს არის ტესტ შეტყობინება ფუდლის რეზერვაციის სისტემიდან.',
        'type' => 'Georgian Simple'
    ],
    [
        'subject' => '[FOODLY] Restaurant Booking Confirmation',
        'content' => 'Dear Restaurant Partner,

This is a test booking notification from the Foodly platform.

Booking Details:
- Date: ' . now()->addDay()->format('Y-m-d') . '
- Time: 19:00
- Guests: 4
- Customer: Test Customer

Please confirm receipt of this email.

Best regards,
Foodly Team',
        'type' => 'Professional Format'
    ]
];

foreach ($testEmails as $email) {
    echo "📧 ტესტირება: $email\n";
    echo str_repeat("=", 50) . "\n";
    
    foreach ($testCases as $index => $testCase) {
        echo "   📝 ტესტი " . ($index + 1) . ": {$testCase['type']}\n";
        
        try {
            $timestamp = now()->format('Y-m-d H:i:s');
            
            Mail::raw($testCase['content'] . "\n\n---\nTest Time: $timestamp\nTarget: $email", function ($message) use ($email, $testCase, $timestamp) {
                $message->to($email)
                        ->subject($testCase['subject'] . " - $timestamp")
                        ->replyTo('admin@foodlyapp.ge', 'Foodly Admin')
                        ->priority(3); // Normal priority
            });
            
            echo "   ✅ გაიგზავნა: {$testCase['subject']}\n";
            
        } catch (Exception $e) {
            echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        }
        
        // Wait between emails
        sleep(2);
    }
    
    echo "\n";
}

// Also test with HTML content
echo "🎨 HTML Email ტესტი foodly.portal@gmail.com-ზე\n";
echo "===============================================\n";

try {
    Mail::send('emails.layouts.test', [], function ($message) use ($targetEmail) {
        $message->to($targetEmail)
                ->subject('🎨 Foodly HTML Email Test - ' . now()->format('H:i:s'))
                ->from('noreply@foodlyapp.ge', 'Foodly System');
    });
    
    echo "✅ HTML Email გაიგზავნა\n";
    
} catch (Exception $e) {
    echo "❌ HTML Email შეცდომა: " . $e->getMessage() . "\n";
    
    // Fallback to simple HTML
    try {
        Mail::html('<h2>🎯 Foodly HTML Test</h2><p>This is a test HTML email from Foodly system.</p><p>Time: ' . now()->format('Y-m-d H:i:s') . '</p>', function ($message) use ($targetEmail) {
            $message->to($targetEmail)
                    ->subject('🎨 Foodly HTML Test (Inline) - ' . now()->format('H:i:s'));
        });
        
        echo "✅ Inline HTML Email გაიგზავნა\n";
        
    } catch (Exception $e2) {
        echo "❌ Inline HTML Email შეცდომა: " . $e2->getMessage() . "\n";
    }
}

echo "\n📋 რეკომენდაციები foodly.portal@gmail.com-ისთვის:\n";
echo "================================================\n";
echo "1. 📱 Gmail Mobile App-ში შეამოწმეთ\n";
echo "2. 🔍 Gmail Search-ში მოძებნეთ: 'from:noreply@foodlyapp.ge'\n";
echo "3. 🗂️ All Mail folder-ში შეამოწმეთ\n";
echo "4. 📧 Spam folder-ში შეამოწმეთ\n";
echo "5. ⚙️ Gmail Settings > Filters and Blocked Addresses შეამოწმეთ\n";
echo "6. 🛡️ Gmail Security tab შეამოწმეთ\n";
echo "7. 💾 Storage შეამოწმეთ (15GB limit)\n";
echo "8. 🔄 Browser cache გაწმინდეთ და თავიდან შეამოწმეთ\n\n";

echo "💡 დამატებითი ტიპები:\n";
echo "===================\n";
echo "• Gmail-ის web version-ში შედით: mail.google.com\n";
echo "• გამოიყენეთ სხვა browser (Chrome/Firefox/Edge)\n";
echo "• Mobile data-ით შეამოწმეთ (არა WiFi)\n";
echo "• Incognito/Private mode-ში შეამოწმეთ\n\n";

echo "🎯 ტესტი დასრულდა!\n";
echo "გაგზავნილია " . (count($testCases) * 2 + 1) . " Email სხვადასხვა ფორმატში.\n";
