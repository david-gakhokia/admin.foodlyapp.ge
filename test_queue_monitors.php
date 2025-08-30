<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Queue Monitoring Options ტესტი\n";
echo "====================================\n\n";

// Check Laravel Horizon
echo "1️⃣ Laravel Horizon Status:\n";
try {
    if (class_exists('Laravel\Horizon\Horizon')) {
        echo "   ✅ Laravel Horizon დაინსტალირდა\n";
        echo "   📂 Horizon Path: /horizon\n";
        echo "   🌐 URL: http://api.foodlyapp.ge.test/horizon\n";
        
        // Check Redis connection
        try {
            \Illuminate\Support\Facades\Redis::ping();
            echo "   ✅ Redis კავშირი მუშაობს\n";
        } catch (Exception $e) {
            echo "   ❌ Redis კავშირის პრობლემა: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ❌ Laravel Horizon არ არის დაინსტალირებული\n";
    }
} catch (Exception $e) {
    echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
}

echo "\n";

// Check Queue Monitor
echo "2️⃣ Laravel Queue Monitor Status:\n";
try {
    if (class_exists('romanzipp\QueueMonitor\QueueMonitor')) {
        echo "   ✅ Laravel Queue Monitor დაინსტალირდა\n";
        echo "   📊 Database Tables: queue_monitor\n";
        
        // Check if table exists
        if (\Illuminate\Support\Facades\Schema::hasTable('queue_monitor')) {
            echo "   ✅ Database Table არსებობს\n";
        } else {
            echo "   ❌ Database Table არ არსებობს\n";
        }
    } else {
        echo "   ❌ Laravel Queue Monitor არ არის დაინსტალირებული\n";
    }
} catch (Exception $e) {
    echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
}

echo "\n";

// Check Custom Queue Controller
echo "3️⃣ Custom Queue Controller Status:\n";
try {
    if (class_exists('App\Http\Controllers\Admin\QueueController')) {
        echo "   ✅ Custom Queue Controller შექმნილია\n";
        echo "   📂 ფაილი: app/Http/Controllers/Admin/QueueController.php\n";
        echo "   🌐 Route: /admin/queue/dashboard\n";
    } else {
        echo "   ❌ Custom Queue Controller არ არსებობს\n";
    }
} catch (Exception $e) {
    echo "   ❌ შეცდომა: " . $e->getMessage() . "\n";
}

echo "\n";

// Check Database Queue Tables
echo "4️⃣ Database Queue Tables:\n";
try {
    $jobsCount = \Illuminate\Support\Facades\DB::table('jobs')->count();
    $failedJobsCount = \Illuminate\Support\Facades\DB::table('failed_jobs')->count();
    
    echo "   📊 Pending Jobs: {$jobsCount}\n";
    echo "   ❌ Failed Jobs: {$failedJobsCount}\n";
    
    if (\Illuminate\Support\Facades\Schema::hasTable('jobs')) {
        echo "   ✅ jobs table არსებობს\n";
    }
    
    if (\Illuminate\Support\Facades\Schema::hasTable('failed_jobs')) {
        echo "   ✅ failed_jobs table არსებობს\n";
    }
    
    if (\Illuminate\Support\Facades\Schema::hasTable('job_batches')) {
        echo "   ✅ job_batches table არსებობს\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ Database შეცდომა: " . $e->getMessage() . "\n";
}

echo "\n";

// Recommendations
echo "💡 რეკომენდაციები:\n";
echo "==================\n";

if (!\Illuminate\Support\Facades\Schema::hasTable('queue_monitor')) {
    echo "🔧 Queue Monitor-ისთვის: php artisan queue-monitor:table\n";
    echo "🔧 შემდეგ: php artisan migrate\n";
}

echo "🌐 Queue Monitoring Options:\n";
echo "   • Laravel Horizon: http://api.foodlyapp.ge.test/horizon (Redis საჭიროა)\n";
echo "   • Custom Dashboard: http://api.foodlyapp.ge.test/admin/queue/dashboard\n";
echo "   • Queue Monitor: php artisan queue-monitor:show\n";

echo "\n🎯 მომენტალური Queue-ის შემოწმება:\n";
echo "   php artisan queue:work --once\n";
echo "   php artisan queue:failed\n";
echo "   php artisan queue:restart\n";

echo "\n✅ Queue Monitoring System მზადაა!\n";
