<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Events\ReservationStatusChanged;
use App\Models\Reservation;

echo "🎯 Queue Testing - რამდენიმე Job-ის შექმნა\n";
echo "==========================================\n\n";

try {
    // ვიპოვოთ რეალური რეზერვაცია
    $reservation = Reservation::first();
    
    if (!$reservation) {
        echo "❌ რეზერვაცია ვერ მოიძებნა\n";
        return;
    }
    
    echo "📧 ტესტ რეზერვაცია ID: {$reservation->id}\n";
    echo "👤 კლიენტი: {$reservation->name}\n\n";
    
    // შევქმნათ რამდენიმე Queue Job სხვადასხვა status-ისთვის
    $testJobs = [
        ['old' => null, 'new' => 'Pending', 'desc' => 'New Reservation'],
        ['old' => 'Pending', 'new' => 'Confirmed', 'desc' => 'Confirmation'],
        ['old' => 'Confirmed', 'new' => 'Completed', 'desc' => 'Completion'],
        ['old' => 'Pending', 'new' => 'Cancelled', 'desc' => 'Cancellation'],
    ];
    
    echo "🚀 Queue Jobs-ების შექმნა:\n";
    echo "============================\n";
    
    foreach ($testJobs as $index => $job) {
        echo "📤 Job " . ($index + 1) . ": {$job['desc']}\n";
        echo "   Status: {$job['old']} → {$job['new']}\n";
        
        try {
            // Dispatch Event რომელიც Email Jobs-ს შექმნის
            ReservationStatusChanged::dispatch($reservation, $job['old'], $job['new']);
            echo "   ✅ წარმატებით შეიქმნა Queue Job!\n";
            
        } catch (Exception $e) {
            echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
        sleep(1); // 1 წამით შეყვანა
    }
    
    // Statistics
    $pendingJobs = \Illuminate\Support\Facades\DB::table('jobs')->count();
    $failedJobs = \Illuminate\Support\Facades\DB::table('failed_jobs')->count();
    
    echo "📊 Queue Status:\n";
    echo "=================\n";
    echo "⏳ Pending Jobs: {$pendingJobs}\n";
    echo "❌ Failed Jobs: {$failedJobs}\n\n";
    
    echo "🌐 Queue Dashboard: http://api.foodlyapp.ge.test/admin/queue/dashboard\n";
    echo "🔧 Laravel Horizon: http://api.foodlyapp.ge.test/horizon\n\n";
    
    echo "💡 Jobs-ების გასამუშავებლად:\n";
    echo "   php artisan queue:work --once\n";
    echo "   php artisan queue:work --stop-when-empty\n\n";
    
    echo "🎉 Test Queue Jobs შექმნილია!\n";
    
} catch (Exception $e) {
    echo "❌ შეცდომა: " . $e->getMessage() . "\n";
    echo "📍 ფაილი: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
