<?php

// Direct PHP mail test for Hostinger
$to = 'david.gakhokia@gmail.com';
$subject = '🧪 FOODLY Direct Test';
$message = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Email</title>
</head>
<body>
    <h1>🍽️ FOODLY Test</h1>
    <p>ეს არის ტესტ მეილი Hostinger SMTP-დან</p>
    <p>თუ ეს მეილი მიიღეთ, კონფიგურაცია სწორია!</p>
</body>
</html>
';

$headers = array(
    'From' => 'noreply@foodlyapp.ge',
    'Reply-To' => 'noreply@foodlyapp.ge',
    'X-Mailer' => 'PHP/' . phpversion(),
    'MIME-Version' => '1.0',
    'Content-type' => 'text/html; charset=UTF-8'
);

echo "📧 Sending direct PHP mail...\n";

if (mail($to, $subject, $message, implode("\r\n", array_map(function($k, $v) {
    return "$k: $v";
}, array_keys($headers), $headers)))) {
    echo "✅ SUCCESS: Mail sent using PHP mail() function\n";
} else {
    echo "❌ FAILED: PHP mail() function failed\n";
}

// Check if mail function is enabled
echo "\n📋 PHP mail configuration:\n";
echo "mail.smtp_server: " . ini_get('SMTP') . "\n";
echo "mail.smtp_port: " . ini_get('smtp_port') . "\n";
echo "sendmail_path: " . ini_get('sendmail_path') . "\n";
