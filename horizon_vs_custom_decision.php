<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application  
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🎯 Laravel Horizon vs Custom Dashboard გადაწყვეტა\n";
echo "==================================================\n\n";

echo "🔍 მიმდინარე Queue სისტემის ანალიზი:\n";
echo "====================================\n";

// Check current queue connection
$queueConnection = config('queue.default');
echo "📊 Queue Connection: {$queueConnection}\n";

// Check available connections
$connections = config('queue.connections');
echo "📋 Available Connections: " . implode(', ', array_keys($connections)) . "\n\n";

// Redis connection test
echo "🔧 Redis კავშირის შემოწმება:\n";
echo "=============================\n";

try {
    \Illuminate\Support\Facades\Redis::ping();
    echo "✅ Redis მუშაობს!\n";
    echo "🚀 Horizon მზადაა გამოსაყენებლად!\n\n";
    
    $redisReady = true;
} catch (Exception $e) {
    echo "❌ Redis არ მუშაობს: " . $e->getMessage() . "\n";
    echo "⚠️ Horizon ვერ იმუშავებს Redis-ის გარეშე\n\n";
    
    $redisReady = false;
}

// Database Queue status
echo "💾 Database Queue სისტემა:\n";
echo "===========================\n";

try {
    $pendingJobs = \Illuminate\Support\Facades\DB::table('jobs')->count();
    $failedJobs = \Illuminate\Support\Facades\DB::table('failed_jobs')->count();
    
    echo "✅ Database Queue მუშაობს\n";
    echo "📊 Pending Jobs: {$pendingJobs}\n";
    echo "❌ Failed Jobs: {$failedJobs}\n\n";
    
    $databaseQueueReady = true;
} catch (Exception $e) {
    echo "❌ Database Queue პრობლემა: " . $e->getMessage() . "\n\n";
    $databaseQueueReady = false;
}

// Laravel Horizon status
echo "🚀 Laravel Horizon სტატუსი:\n";
echo "============================\n";

if (class_exists('Laravel\Horizon\Horizon')) {
    echo "✅ Laravel Horizon დაინსტალირებულია\n";
    echo "📂 Version: დაინსტალირებულია\n";
    echo "🌐 URL: http://api.foodlyapp.ge.test/horizon\n";
    
    if ($redisReady) {
        echo "✅ Horizon მზადაა გამოსაყენებლად!\n";
    } else {
        echo "⚠️ Redis საჭიროა Horizon-ისთვის\n";
    }
} else {
    echo "❌ Laravel Horizon არ არის დაინსტალირებული\n";
}

echo "\n";

// Custom Dashboard status
echo "🔧 Custom Queue Dashboard:\n";
echo "===========================\n";

if (class_exists('App\Http\Controllers\Admin\QueueController')) {
    echo "✅ Custom Dashboard შექმნილია\n";
    echo "🌐 URL: http://api.foodlyapp.ge.test/admin/queue/dashboard\n";
    
    if ($databaseQueueReady) {
        echo "✅ Database Queue-ით მუშაობს\n";
    } else {
        echo "⚠️ Database Queue პრობლემა\n";
    }
} else {
    echo "❌ Custom Dashboard არ არსებობს\n";
}

echo "\n";

// Recommendations
echo "💡 რეკომენდაციები:\n";
echo "==================\n";

if ($redisReady) {
    echo "🎯 Redis მუშაობს - გამოიყენეთ Laravel Horizon!\n";
    echo "   1. Queue Connection შეცვლა: QUEUE_CONNECTION=redis\n";
    echo "   2. Horizon გაშვება: php artisan horizon\n";
    echo "   3. Horizon Dashboard: http://api.foodlyapp.ge.test/horizon\n\n";
    
    echo "🗑️ Custom Dashboard შეიძლება წაიშალოს\n";
} else {
    echo "⚠️ Redis არ მუშაობს - გამოიყენეთ Database Queue + Custom Dashboard\n";
    echo "   1. Queue Connection: QUEUE_CONNECTION=database (მიმდინარე)\n";
    echo "   2. Custom Dashboard: http://api.foodlyapp.ge.test/admin/queue/dashboard\n";
    echo "   3. Redis ინსტალაცია მომავლისთვის\n\n";
    
    echo "🔧 Redis დასაინსტალებლად:\n";
    echo "   • Windows: choco install redis-64 ან Docker\n";
    echo "   • Docker: docker run -d -p 6379:6379 redis:alpine\n";
}

echo "\n🎯 შეჯამება:\n";
echo "============\n";

if ($redisReady) {
    echo "✅ გამოიყენეთ Laravel Horizon (Redis მუშაობს)\n";
    echo "🗑️ Custom Dashboard არ არის საჭირო\n";
} else {
    echo "⚠️ Custom Dashboard საჭიროა (Redis არ მუშაობს)\n"; 
    echo "🔮 Horizon მომავლისთვის (Redis-ის შემდეგ)\n";
}

echo "\n📧 Email Queue System მზადაა ორივე ვარიანტით!\n";
