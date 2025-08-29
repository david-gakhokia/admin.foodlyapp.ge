<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Mail\Client\ClientPendingEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Admin\AdminPendingEmail;

echo "📧 Email ტესტი რამდენიმე მისამართზე\n";
echo "=====================================\n\n";

// Test emails list
$testEmails = [
    'david.gakhokia@gmail.com',
    'gakhokia.david@gmail.com', 
    'dev.foodly@gmail.com',
    'foodly.portal@gmail.com'
];

// Create test reservation
$testReservation = (object) [
    'id' => 12345,
    'name' => 'დავით გახოკია',
    'email' => 'david.gakhokia@gmail.com',
    'phone' => '+995555123456',
    'reservation_date' => now()->addDay()->format('Y-m-d'),
    'time_from' => '19:00',
    'time_to' => '21:00',
    'guests_count' => 4,
    'status' => 'Pending',
    'notes' => 'ტესტ რეზერვაცია Email-ების შესამოწმებლად',
    'type' => 'restaurant',
    'reservable_type' => 'App\\Models\\Restaurant',
    'reservable_id' => 1
];

// Add method for restaurant name
class TestReservation {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $reservation_date;
    public $time_from;
    public $time_to;
    public $guests_count;
    public $status;
    public $notes;
    public $type;
    public $reservable_type;
    public $reservable_id;
    
    public function __construct($data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
    
    public function getRestaurantName() {
        return 'ტესტ რესტორანი';
    }
}

$reservation = new TestReservation((array)$testReservation);

echo "🎯 ტესტ რეზერვაცია:\n";
echo "   ID: {$reservation->id}\n";
echo "   კლიენტი: {$reservation->name}\n";
echo "   თარიღი: {$reservation->reservation_date}\n";
echo "   დრო: {$reservation->time_from} - {$reservation->time_to}\n\n";

foreach ($testEmails as $email) {
    echo "📮 ტესტირება: $email\n";
    
    try {
        // 1. Simple test email
        echo "   ↗️ მარტივი ტესტ...\n";
        Mail::raw("ეს არის ტესტ შეტყობინება $email მისამართზე", function ($message) use ($email) {
            $message->to($email)
                    ->subject('🧪 Foodly ტესტ Email - ' . now()->format('H:i:s'));
        });
        echo "   ✅ მარტივი ტესტი გაიგზავნა\n";
        
        // 2. Client pending email
        echo "   ↗️ კლიენტის Email...\n";
        $clientMail = new ClientPendingEmail($reservation);
        Mail::to($email)->send($clientMail);
        echo "   ✅ კლიენტის Email გაიგზავნა\n";
        
        // 3. Restaurant pending email
        echo "   ↗️ რესტორნის Email...\n";
        $restaurantMail = new RestauranPendingEmail($reservation);
        Mail::to($email)->send($restaurantMail);
        echo "   ✅ რესტორნის Email გაიგზავნა\n";
        
        // 4. Admin pending email  
        echo "   ↗️ ადმინის Email...\n";
        $adminMail = new AdminPendingEmail($reservation);
        Mail::to($email)->send($adminMail);
        echo "   ✅ ადმინის Email გაიგზავნა\n";
        
        echo "   🎉 ყველა Email წარმატებით გაიგზავნა!\n\n";
        
        // Wait between emails to avoid rate limiting
        sleep(2);
        
    } catch (Exception $e) {
        echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        echo "   📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    }
}

echo "📊 შეჯამება:\n";
echo "=============\n";
echo "✅ გაგზავნილია ტესტ Email-ები " . count($testEmails) . " მისამართზე\n";
echo "📧 თითოეულ მისამართზე გაიგზავნა 4 სახეობის Email:\n";
echo "   1. მარტივი ტესტ შეტყობინება\n";
echo "   2. კლიენტის Pending Email (styled)\n";
echo "   3. რესტორნის Pending Email (styled)\n";
echo "   4. ადმინის Pending Email (styled)\n\n";

echo "🔍 შეამოწმეთ Inbox-ები:\n";
foreach ($testEmails as $email) {
    echo "   📬 $email\n";
}

echo "\n💡 თუ Email-ები არ მოდის:\n";
echo "   1. შეამოწმეთ Spam/Junk folder\n";
echo "   2. შეამოწმეთ Laravel logs: storage/logs/laravel.log\n";
echo "   3. შეამოწმეთ SMTP settings .env ფაილში\n";
echo "   4. ჩართეთ queue worker: php artisan queue:work\n\n";

echo "🎯 ტესტი დასრულდა!\n";
