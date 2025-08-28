<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

echo "🧪 Testing Reservation Creation with Email Notifications\n";
echo "========================================================\n\n";

try {
    // ვამოწმებთ არსებულ სტრუქტურას
    echo "📊 Checking database structure...\n";
    
    $restaurantsCount = Restaurant::count();
    $citiesCount = City::count();
    $pendingJobs = DB::table('jobs')->count();
    
    echo "Cities: {$citiesCount}\n";
    echo "Restaurants: {$restaurantsCount}\n";
    echo "Pending jobs in queue: {$pendingJobs}\n\n";
    
    $restaurant = Restaurant::first();
    if (!$restaurant) {
        echo "❌ No restaurants found!\n";
        exit(1);
    }
    echo "✅ Using restaurant: {$restaurant->name}\n\n";
    
    echo "📝 Creating test reservation...\n";
    
    // Event listening ჩავრთოთ
    Event::listen('*', function ($eventName, array $data) {
        if (str_contains($eventName, 'Reservation')) {
            echo "🔔 Event fired: {$eventName}\n";
        }
    });
    
    // შევქმნათ რეზერვაცია სწორი ველებით
    $reservation = Reservation::create([
        'type' => 'restaurant',
        'reservable_type' => 'App\Models\Restaurant',
        'reservable_id' => $restaurant->id,
        'name' => 'ნინო გელაშვილი',
        'email' => 'david.gakhokia@gmail.com',
        'phone' => '+995555987654',
        'guests_count' => 4,
        'reservation_date' => Carbon::tomorrow()->format('Y-m-d'),
        'time_from' => '19:00:00',
        'time_to' => '21:00:00',
        'notes' => 'ბავშვის სკამი გვჭირდება',
        'status' => 'pending'
    ]);
    
    echo "✅ Reservation created!\n";
    echo "   ID: {$reservation->id}\n";
    echo "   Client: {$reservation->name}\n";
    echo "   Email: {$reservation->email}\n";
    echo "   Date: {$reservation->reservation_date} {$reservation->time_from} - {$reservation->time_to}\n";
    echo "   Status: {$reservation->status}\n\n";

    // შევამოწმოთ jobs
    $newJobsCount = DB::table('jobs')->count();
    echo "📬 Jobs in queue after creation: {$newJobsCount}\n";
    
    if ($newJobsCount > $pendingJobs) {
        echo "✅ New jobs were created! (" . ($newJobsCount - $pendingJobs) . " new jobs)\n";
        
        // გავიყვანოთ jobs ცხრილის დეტალები
        $jobs = DB::table('jobs')->latest('id')->take(3)->get(['id', 'queue', 'payload']);
        
        echo "\n📋 Recent jobs:\n";
        foreach ($jobs as $job) {
            $payload = json_decode($job->payload, true);
            $displayName = $payload['displayName'] ?? 'Unknown Job';
            echo "   Job #{$job->id}: {$displayName}\n";
        }
    } else {
        echo "⚠️  No new jobs were created. Let's test status change...\n";
        
        // Manual event dispatch
        echo "\n🔧 Testing ReservationStatusChanged event...\n";
        
        if (class_exists(\App\Events\ReservationStatusChanged::class)) {
            event(new \App\Events\ReservationStatusChanged($reservation, null, 'pending'));
            
            $finalJobsCount = DB::table('jobs')->count();
            echo "📬 Jobs after manual event: {$finalJobsCount}\n";
            
            if ($finalJobsCount > $newJobsCount) {
                echo "✅ Status change event created jobs!\n";
            }
        } else {
            echo "❌ ReservationStatusChanged event class not found\n";
        }
    }
    
    echo "\n🎯 Next steps:\n";
    echo "1. Run: php artisan queue:work --stop-when-empty\n";
    echo "2. Check your email: nino@test.com\n";
    echo "3. Check logs for any errors\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Test completed!\n";
