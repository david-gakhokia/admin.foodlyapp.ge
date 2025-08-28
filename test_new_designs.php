<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Mail\Client\ClientConfirmedEmail;
use App\Mail\Restaurant\RestaurantConfirmedEmail;
use App\Mail\Admin\AdminConfirmedEmail;
use Illuminate\Support\Facades\Mail;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🎨 ტესტირება: ახალი email დიზაინები\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Create test reservation data
$testReservation = (object) [
    'id' => 'TEST-' . date('YmdHis'),
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995 599 123 456',
    'guests_count' => 4,
    'reservation_date' => '2024-12-15',
    'time_from' => '19:00',
    'time_to' => '21:00',
    'status' => 'confirmed',
    'notes' => 'გთხოვთ მოამზადოთ ბავშვისთვის სპეციალური მენიუ',
    'getRestaurantName' => function() {
        return 'ბაბილონი რესტორანი';
    }
];

try {
    echo "📧 1. კლიენტის email (მხიარული დიზაინი)...\n";
    $clientMail = new ClientConfirmedEmail($testReservation);
    Mail::to('david.gakhokia@gmail.com')->send($clientMail);
    echo "✅ კლიენტის email გაგზავნილია\n\n";

    sleep(2);

    echo "🏢 2. რესტორნის email (საქმიანი დიზაინი)...\n";
    $restaurantMail = new RestaurantConfirmedEmail($testReservation);
    Mail::to('david.gakhokia@gmail.com')->send($restaurantMail);
    echo "✅ რესტორნის email გაგზავნილია\n\n";

    sleep(2);

    echo "🛡️ 3. ადმინის email (დეტალური დიზაინი)...\n";
    $adminMail = new AdminConfirmedEmail($testReservation);
    Mail::to('david.gakhokia@gmail.com')->send($adminMail);
    echo "✅ ადმინის email გაგზავნილია\n\n";

    echo "🎉 ყველა email წარმატებით გაგზავნილია!\n";
    echo "📱 შეამოწმეთ თქვენი მეილბოქსი david.gakhokia@gmail.com\n\n";

    echo "📊 შედეგი:\n";
    echo "✅ კლიენტის email: მხიარული და ღია დიზაინი\n";
    echo "✅ რესტორნის email: საქმიანი და პროფესიონალური\n";
    echo "✅ ადმინის email: დეტალური და ინფორმაციული\n";

} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📄 ლოგი: " . $e->getTraceAsString() . "\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "ტესტი დასრულებულია - " . date('Y-m-d H:i:s') . "\n";
