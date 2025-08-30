<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🎯 Laravel Horizon Setup Test\n";
echo "=============================\n\n";

try {
    // Check if Horizon is installed
    $horizonInstalled = class_exists('Laravel\Horizon\Horizon');
    echo "📦 Horizon Installation: " . ($horizonInstalled ? "✅ INSTALLED" : "❌ NOT FOUND") . "\n";
    
    if ($horizonInstalled) {
        echo "🎯 Horizon Path: " . config('horizon.path', 'horizon') . "\n";
        echo "🌐 Dashboard URL: " . url('/' . config('horizon.path', 'horizon')) . "\n\n";
    }
    
    // Check Queue Configuration
    echo "⚙️ Queue Configuration:\n";
    echo "   Connection: " . config('queue.default') . "\n";
    echo "   Driver: " . config('queue.connections.' . config('queue.default') . '.driver') . "\n";
    
    if (config('queue.default') === 'redis') {
        echo "   Redis Host: " . config('database.redis.default.host') . "\n";
        echo "   Redis Port: " . config('database.redis.default.port') . "\n";
    }
    
    echo "\n";
    
    // Check Redis availability (if needed)
    if (config('queue.default') === 'redis') {
        try {
            $redis = \Illuminate\Support\Facades\Redis::connection();
            $redis->ping();
            echo "🔴 Redis Status: ✅ CONNECTED\n";
        } catch (Exception $e) {
            echo "🔴 Redis Status: ❌ FAILED - " . $e->getMessage() . "\n";
        }
    }
    
    // Check Database Tables (for database queue)
    if (config('queue.default') === 'database') {
        try {
            $jobsCount = \DB::table('jobs')->count();
            $failedCount = \DB::table('failed_jobs')->count();
            echo "💾 Database Queue Status: ✅ READY\n";
            echo "   Pending Jobs: {$jobsCount}\n";
            echo "   Failed Jobs: {$failedCount}\n";
        } catch (Exception $e) {
            echo "💾 Database Queue Status: ❌ FAILED - " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n";
    
    // Check Horizon Configuration
    if ($horizonInstalled) {
        echo "🔧 Horizon Configuration:\n";
        
        $environments = config('horizon.environments', []);
        echo "   Environments: " . implode(', ', array_keys($environments)) . "\n";
        
        if (isset($environments['local'])) {
            $supervisor = $environments['local']['supervisor-1'] ?? [];
            echo "   Workers: " . ($supervisor['processes'] ?? 'Not set') . "\n";
            echo "   Queue: " . ($supervisor['queue'] ?? 'default') . "\n";
        }
    }
    
    echo "\n";
    echo "🚀 Next Steps:\n";
    echo "==============\n";
    
    if (!$horizonInstalled) {
        echo "1. Run: composer require laravel/horizon\n";
        echo "2. Run: php artisan horizon:install\n";
    } else {
        if (config('queue.default') === 'database') {
            echo "⚠️  For optimal Horizon experience, consider switching to Redis:\n";
            echo "   1. Update .env: QUEUE_CONNECTION=redis\n";
            echo "   2. Ensure Redis is running\n";
            echo "   3. Test: php artisan horizon\n\n";
            
            echo "📊 Current Database Queue works fine with Horizon too!\n";
            echo "   - Start Horizon: php artisan horizon\n";
            echo "   - Visit Dashboard: " . url('/horizon') . "\n";
        } else {
            echo "✅ Ready to start Horizon!\n";
            echo "   1. Start: php artisan horizon\n";
            echo "   2. Visit: " . url('/horizon') . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
