<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstr    // შევქმნათ რეზერვაცია
    $reservation = Reservation::create([
        'type' => 'restaurant',
        'reservable_type' => 'App\Models\Restaurant',
        'reservable_id' => $restaurant->id,
        'name' => 'ნინო გელაშვილი',
        'email' => 'nino@test.com',
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
    echo "   Status: {$reservation->status}\n\n";require_once __DIR__ . '/bootstrap/app.php';
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
    
    if ($restaurantsCount == 0) {
        echo "❌ No restaurants found. Creating test data...\n";
        
        // შევქმნათ city
        $city = City::firstOrCreate([
            'name' => 'თბილისი',
            'slug' => 'tbilisi'
        ]);
        
        // შევქმნათ restaurant
        $restaurant = Restaurant::create([
            'name' => 'Test Restaurant',
            'slug' => 'test-restaurant',
            'city_id' => $city->id,
            'address' => 'Test Address',
            'phone' => '+995555123456',
            'email' => 'restaurant@test.com',
            'is_active' => true,
            'capacity' => 50,
            'opening_time' => '10:00',
            'closing_time' => '23:00'
        ]);
        
        echo "✅ Test restaurant created: {$restaurant->name}\n";
    } else {
        $restaurant = Restaurant::first();
        echo "✅ Using existing restaurant: {$restaurant->name}\n";
    }
    
    echo "\n📝 Creating test reservation...\n";
    
    // Event listening ჩავრთოთ
    Event::listen('*', function ($eventName, array $data) {
        if (str_contains($eventName, 'Reservation')) {
            echo "🔔 Event fired: {$eventName}\n";
        }
    });
    
    // შევქმნათ რეზერვაცია
    $reservation = Reservation::create([
        'restaurant_id' => $restaurant->id,
        'client_name' => 'ნინო გელაშვილი',
        'client_email' => 'david.gakhokia@gmail.com',
        'client_phone' => '+995598970616',
        'guest_count' => 4,
        'reservation_date' => Carbon::tomorrow()->format('Y-m-d'),
        'reservation_time' => '19:00:00',
        'special_requests' => 'ბავშვის სკამი გვჭირდება',
        'status' => 'pending'
    ]);
    
    echo "✅ Reservation created!\n";
    echo "   ID: {$reservation->id}\n";
    echo "   Client: {$reservation->client_name}\n";
    echo "   Email: {$reservation->client_email}\n";
    echo "   Date: {$reservation->reservation_date} {$reservation->reservation_time}\n";
    echo "   Status: {$reservation->status}\n\n";

    // 3. შევამოწმოთ თუ გაიშვა Event
    echo "🎯 Triggering ReservationStatusChanged event...\n";
    
    // Event-ის გაშვება
    \App\Events\ReservationStatusChanged::dispatch($reservation, null, 'Pending');
    
    echo "✅ Event dispatched!\n\n";

    // 4. შევამოწმოთ jobs queue
    $newJobsCount = \Illuminate\Support\Facades\DB::table('jobs')->count();
    $addedJobs = $newJobsCount - $jobsCount;
    
    echo "📊 Jobs after event: {$newJobsCount} (+{$addedJobs})\n\n";

    if ($addedJobs > 0) {
        echo "🎉 Success! {$addedJobs} email jobs were queued!\n";
        echo "📝 To process them, run: php artisan queue:work --stop-when-empty\n\n";
        
        // შევხედოთ რა jobs დაემატა
        $jobs = \Illuminate\Support\Facades\DB::table('jobs')
            ->orderBy('id', 'desc')
            ->limit($addedJobs)
            ->get(['id', 'queue', 'payload']);
            
        echo "📋 Queued jobs:\n";
        foreach ($jobs as $job) {
            $payload = json_decode($job->payload, true);
            $jobClass = $payload['displayName'] ?? 'Unknown';
            echo "  - Job #{$job->id}: {$jobClass}\n";
        }
    } else {
        echo "⚠️  No jobs were queued. Check Event/Listener configuration.\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n🏁 Test completed!\n";
