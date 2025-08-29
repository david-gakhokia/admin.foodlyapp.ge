<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Mail\Client\ClientPendingEmail;
use App\Mail\Restaurant\RestauranPendingEmail;
use App\Mail\Admin\AdminPendingEmail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

echo "🎨 ტესტირება: განახლებული Pending Email დიზაინები\n";
echo "====================================================\n\n";

try {
    // ტესტ რეზერვაციის მონაცემები
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
        'notes' => 'ტესტ რეზერვაცია განახლებული დიზაინებისთვის',
        'type' => 'restaurant',
        'reservable_type' => 'App\\Models\\Restaurant',
        'reservable_id' => 1
    ];

    // Add method for restaurant name
    class TestReservationWithDesign {
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
            return 'ტესტ რესტორანი - ღია ცის ქვეშ';
        }
    }

    $reservation = new TestReservationWithDesign((array)$testReservation);

    echo "🎯 ტესტ რეზერვაცია:\n";
    echo "   ID: {$reservation->id}\n";
    echo "   კლიენტი: {$reservation->name}\n";
    echo "   რესტორანი: " . $reservation->getRestaurantName() . "\n";
    echo "   თარიღი: {$reservation->reservation_date}\n";
    echo "   დრო: {$reservation->time_from} - {$reservation->time_to}\n";
    echo "   სტუმრები: {$reservation->guests_count}\n\n";

    $testEmails = [
        'david.gakhokia@gmail.com' => 'მთავარი',
        'gakhokia.david@gmail.com' => 'მეორადი'
    ];

    foreach ($testEmails as $email => $description) {
        echo "📧 Email: $email ($description)\n";
        echo str_repeat("-", 40) . "\n";
        
        // 1. Client Pending Email (განახლებული დიზაინით)
        echo "   👤 Client Pending Email...\n";
        try {
            $clientMail = new ClientPendingEmail($reservation);
            Mail::to($email)->send($clientMail);
            echo "   ✅ კლიენტის Email გაიგზავნა (emails.client.pending)\n";
        } catch (Exception $e) {
            echo "   ❌ კლიენტის Email შეცდომა: " . $e->getMessage() . "\n";
        }
        
        sleep(1);
        
        // 2. Restaurant Pending Email (განახლებული დიზაინით)
        echo "   🏪 Restaurant Pending Email...\n";
        try {
            $restaurantMail = new RestauranPendingEmail($reservation);
            Mail::to($email)->send($restaurantMail);
            echo "   ✅ რესტორნის Email გაიგზავნა (emails.restaurant.pending)\n";
        } catch (Exception $e) {
            echo "   ❌ რესტორნის Email შეცდომა: " . $e->getMessage() . "\n";
        }
        
        sleep(1);
        
        // 3. Admin Pending Email (განახლებული დიზაინით)
        echo "   🛡️ Admin Pending Email...\n";
        try {
            $adminMail = new AdminPendingEmail($reservation);
            Mail::to($email)->send($adminMail);
            echo "   ✅ ადმინის Email გაიგზავნა (emails.admin.pending)\n";
        } catch (Exception $e) {
            echo "   ❌ ადმინის Email შეცდომა: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
        sleep(2); // Wait between different recipients
    }

    echo "🎉 შეჯამება:\n";
    echo "=============\n";
    echo "✅ ყველა Mail კლასი განახლდა სწორი view-ების გამოსაყენებლად:\n";
    echo "   📧 ClientPendingEmail → emails.client.pending\n";
    echo "   🏪 RestauranPendingEmail → emails.restaurant.pending\n";
    echo "   🛡️ AdminPendingEmail → emails.admin.pending\n\n";
    
    echo "🎨 თითოეული Email-ს ექნება საკუთარი დიზაინი:\n";
    echo "   👤 კლიენტისთვის: თბილი ოცნაური დიზაინი\n";
    echo "   🏪 რესტორნისთვის: საქმიანი, პროფესიონალური დიზაინი\n";
    echo "   🛡️ ადმინისთვის: ღია, დეტალური ადმინისტრაციული დიზაინი\n\n";
    
    echo "📬 შეამოწმეთ Email inbox-ები მომდევნო 2-3 წუთში!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
