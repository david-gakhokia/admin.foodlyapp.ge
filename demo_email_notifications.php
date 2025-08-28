<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Events\ReservationStatusChanged;

// Setup Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create a test reservation object with restaurant relationship
$reservation = (object) [
    'id' => 456,
    'name' => 'Test Client Fix',
    'email' => 'client-fix@example.com',
    'status' => 'Pending',
    'price' => 50,
    'restaurant' => (object) [
        'name' => 'Demo Restaurant Fixed',
        'email' => 'restaurant-fix@example.com',
        'admins' => [
            (object)['email' => 'admin-fix@example.com']
        ]
    ]
];
$reservation = (object) [
    'id' => 123,
    'name' => 'Test Client',
    'email' => 'gakhokia.david@gmail.com',
    'status' => 'Pending',
    'restaurant' => (object) [
        'name' => 'Demo Restaurant',
        'email' => 'dev.foodly@gmail.com',
        'admins' => [
            (object)['email' => 'admin@foodlyapp.ge']
        ]
    ]
];

echo "🚀 Testing Reservation Status Change Email System\n";
echo "=================================================\n";
echo "Reservation ID: {$reservation->id}\n";
echo "Client: {$reservation->name} ({$reservation->email})\n";
echo "Restaurant: {$reservation->restaurant->name} ({$reservation->restaurant->email})\n";
echo "Admin: admin@foodlyapp.ge\n";
echo "\n";

echo "📧 Dispatching ReservationStatusChanged event...\n";

try {
    // Dispatch the event
    ReservationStatusChanged::dispatch($reservation, 'Pending', 'Confirmed');
    
    echo "✅ Event dispatched successfully!\n";
    echo "\n";
    echo "🎯 Expected behavior:\n";
    echo "  - Admin should receive confirmation email\n";
    echo "  - Client should receive confirmation email\n";
    echo "  - Restaurant should receive confirmation email\n";
    echo "\n";
    echo "💡 Check your logs and queue jobs to see if emails were processed.\n";
    echo "📝 Run 'php artisan queue:work' to process the jobs.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n";
echo "🏁 Demo completed!\n";
