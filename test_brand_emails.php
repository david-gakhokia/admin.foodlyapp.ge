<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientConfirmedEmail;
use App\Mail\Restaurant\RestaurantConfirmedEmail;
use App\Mail\Admin\AdminConfirmedEmail;

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

echo "🎨 FOODLY ბრენდული მეილების ტესტირება\n";
echo "=====================================\n\n";

try {
    // 1. Client Email Test
    echo "📧 კლიენტის მეილის გაგზავნა...\n";
    echo "მიმღები: david.gakhokia@gmail.com\n";
    
    $clientMail = new ClientConfirmedEmail($testReservation);
    Mail::to('david.gakhokia@gmail.com')->send($clientMail);
    echo "✅ კლიენტის მეილი გაიგზავნა წარმატებით!\n\n";
    
    // 2. Restaurant Email Test
    echo "🏪 რესტორნის მეილის გაგზავნა...\n";
    echo "მიმღები: foodly.portal@gmail.com\n";
    
    $restaurantMail = new RestaurantConfirmedEmail($testReservation);
    Mail::to('foodly.portal@gmail.com')->send($restaurantMail);
    echo "✅ რესტორნის მეილი გაიგზავნა წარმატებით!\n\n";
    
    // 3. Admin Email Test
    echo "👨‍💼 ადმინის მეილის გაგზავნა...\n";
    echo "მიმღები: admin@foodlyapp.ge\n";
    
    $adminMail = new AdminConfirmedEmail($testReservation);
    Mail::to('admin@foodlyapp.ge')->send($adminMail);
    echo "✅ ადმინის მეილი გაიგზავნა წარმატებით!\n\n";
    
    echo "🎉 ყველა ტესტი დასრულდა წარმატებით!\n";
    echo "================================\n";
    echo "შეამოწმეთ ინბოქსები:\n";
    echo "- Client: david.gakhokia@gmail.com\n";
    echo "- Restaurant: foodly.portal@gmail.com\n";
    echo "- Admin: admin@foodlyapp.ge\n\n";
    echo "🎨 ახალი FOODLY ბრენდული ფერები დანერგილია!\n";
    echo "- Primary Orange: #ff6b35\n";
    echo "- Secondary Orange: #f7931e\n";
    echo "- Success Green: #22c55e\n";
    echo "- Error Red: #ef4444\n\n";
    echo "📱 ყველა ლეიაუტი განახლებულია:\n";
    echo "- Client Layout: ნარინჯისფერი ტონები\n";
    echo "- Admin Layout: ბრენდული ფერები\n";
    echo "- Restaurant Layout: FOODLY სტილი\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "დეტალები: " . $e->getTraceAsString() . "\n";
}
