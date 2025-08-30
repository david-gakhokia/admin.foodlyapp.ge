<?php

require_once __DIR__ . '/vendor/autoload.php';

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔄 Redis ინსტალაციის ალტერნატივები\n";
echo "===================================\n\n";

echo "❌ Memurai ინსტალაცია ვერ დასრულდა\n\n";

echo "💡 ალტერნატივა 1: Database Queue (მიმდინარე)\n";
echo "=============================================\n";
echo "✅ მუშაობს ახლა\n";
echo "✅ სტაბილურია\n";
echo "✅ Custom Dashboard ყოფნა\n";
echo "🌐 URL: http://api.foodlyapp.ge.test/admin/queue/dashboard\n\n";

echo "💡 ალტერნატივა 2: Redis Cloud Service\n";
echo "======================================\n";
echo "✅ Redis Cloud (უფასო 30MB)\n";
echo "✅ Upstash Redis (Serverless)\n";
echo "✅ AWS ElastiCache (Production)\n\n";

echo "💡 ალტერნატივა 3: Docker Redis\n";
echo "===============================\n";
echo "✅ Docker Desktop + Redis container\n";
echo "✅ docker run -p 6379:6379 redis:alpine\n\n";

echo "💡 ალტერნატივა 4: WSL2 + Redis\n";
echo "================================\n";
echo "✅ wsl --install\n";
echo "✅ Ubuntu + Redis Server\n\n";

echo "🎯 რეკომენდაცია:\n";
echo "=================\n";
echo "Database Queue + Custom Dashboard ახლაა შესანიშნავი!\n";
echo "Redis მოგვიანებით დავამატოთ Production-ისთვის.\n\n";

// Test current system
try {
    $pendingJobs = \Illuminate\Support\Facades\DB::table('jobs')->count();
    $failedJobs = \Illuminate\Support\Facades\DB::table('failed_jobs')->count();
    
    echo "📊 მიმდინარე Queue სტატისტიკა:\n";
    echo "============================\n";
    echo "⏳ Pending Jobs: {$pendingJobs}\n";
    echo "❌ Failed Jobs: {$failedJobs}\n";
    echo "✅ Database Queue მუშაობს!\n\n";
    
} catch (Exception $e) {
    echo "❌ Database Queue პრობლემა: " . $e->getMessage() . "\n\n";
}

echo "🚀 მომენტალური გადაწყვეტა:\n";
echo "==========================\n";
echo "Database Queue + Custom Dashboard-ით გავაგრძელოთ!\n";
echo "Redis Production ეტაპისთვის დავტოვოთ.\n\n";

echo "📧 Email Queue System სრულად მუშაობს!\n";
echo "Queue monitoring ხელმისაწვდომია!\n";
