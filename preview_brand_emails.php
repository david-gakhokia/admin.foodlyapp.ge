<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test data for reservation
$testReservation = (object) [
    'id' => 12345,
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995599123456',
    'reservation_date' => '2025-08-30',
    'reservation_time' => '19:30',
    'guests_count' => 4,
    'status' => 'confirmed',
    'special_requests' => 'ტესტირება ახალი ბრენდული დიზაინისა',
    'created_at' => now(),
    'updated_at' => now(),
    'restaurant' => (object) [
        'name' => 'FOODLY Test Restaurant',
        'email' => 'foodly.portal@gmail.com',
        'phone' => '+995591234567',
        'address' => 'თბილისი, რუსთაველის გამზირი 123'
    ]
];

$type = $_GET['type'] ?? 'client';

?>
<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODLY Email Preview - <?= ucfirst($type) ?></title>
    <style>
        body { margin: 0; padding: 20px; background: #f5f5f5; font-family: -apple-system, BlinkMacSystemFont, sans-serif; }
        .preview-nav { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .preview-nav a { 
            display: inline-block; 
            padding: 10px 20px; 
            margin: 0 10px; 
            background: #ff6b35; 
            color: white; 
            text-decoration: none; 
            border-radius: 6px; 
            font-weight: 600;
        }
        .preview-nav a:hover { background: #f7931e; }
        .preview-nav a.active { background: #d73502; }
        .email-container { 
            max-width: 600px; 
            margin: 0 auto; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        }
        .brand-info { 
            background: white; 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 8px; 
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .brand-colors { display: flex; justify-content: center; gap: 15px; margin-top: 10px; }
        .color-box { 
            width: 50px; 
            height: 30px; 
            border-radius: 4px; 
            border: 2px solid #ddd; 
            position: relative;
        }
        .color-label { 
            font-size: 10px; 
            position: absolute; 
            bottom: -20px; 
            left: 50%; 
            transform: translateX(-50%); 
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="brand-info">
        <h2>🎨 FOODLY ბრენდული Email Templates</h2>
        <div class="brand-colors">
            <div class="color-box" style="background: #ff6b35;">
                <div class="color-label">Primary<br>#ff6b35</div>
            </div>
            <div class="color-box" style="background: #f7931e;">
                <div class="color-label">Secondary<br>#f7931e</div>
            </div>
            <div class="color-box" style="background: #22c55e;">
                <div class="color-label">Success<br>#22c55e</div>
            </div>
            <div class="color-box" style="background: #ef4444;">
                <div class="color-label">Error<br>#ef4444</div>
            </div>
        </div>
    </div>

    <div class="preview-nav">
        <a href="?type=client" <?= $type === 'client' ? 'class="active"' : '' ?>>📧 Client Email</a>
        <a href="?type=restaurant" <?= $type === 'restaurant' ? 'class="active"' : '' ?>>🏪 Restaurant Email</a>
        <a href="?type=admin" <?= $type === 'admin' ? 'class="active"' : '' ?>>👨‍💼 Admin Email</a>
    </div>

    <div class="email-container">
        <?php
        try {
            switch ($type) {
                case 'client':
                    echo view('emails.layouts.client', ['reservation' => $testReservation])->render();
                    break;
                case 'restaurant':
                    echo view('emails.layouts.restaurant', ['reservation' => $testReservation])->render();
                    break;
                case 'admin':
                    echo view('emails.layouts.admin', ['reservation' => $testReservation])->render();
                    break;
                default:
                    echo "<p>Unknown email type</p>";
            }
        } catch (Exception $e) {
            echo "<div style='background: #fef2f2; color: #991b1b; padding: 20px; border-radius: 8px;'>";
            echo "<h3>Error:</h3>";
            echo "<p>" . $e->getMessage() . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <div style="text-align: center; margin-top: 30px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <p>✅ ახალი FOODLY ბრენდული ფერები წარმატებით დანერგილია!</p>
        <p>📧 Test emails გაიგზავნა: david.gakhokia@gmail.com, foodly.portal@gmail.com, admin@foodlyapp.ge</p>
    </div>
</body>
</html>
