<?php

// Simple debug script to check our changes
echo "=== Checking Modified Files ===\n\n";

// Check if our modified files exist and have the changes
$files_to_check = [
    'app/Livewire/ReservationStatusUpdater.php',
    'app/Http/Controllers/Admin/ReservationController.php',
    'app/Listeners/Admin/QueueAdminReservationEmails.php'
];

foreach ($files_to_check as $file) {
    echo "Checking: $file\n";
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        if (strpos($content, 'ReservationStatusChanged') !== false) {
            echo "✓ Contains ReservationStatusChanged import/usage\n";
        } else {
            echo "✗ Missing ReservationStatusChanged\n";
        }
        
        if (strpos($content, 'dispatch') !== false || strpos($content, 'ReservationStatusChanged::dispatch') !== false) {
            echo "✓ Contains dispatch call\n";
        } else {
            echo "✗ Missing dispatch call\n";
        }
        
        echo "\n";
    } else {
        echo "File not found!\n\n";
    }
}

echo "=== Summary ===\n";
echo "The following changes were made to fix notification issues:\n";
echo "1. Added ReservationStatusChanged event dispatch to Livewire component\n";
echo "2. Added ReservationStatusChanged event dispatch to Admin Controller\n";
echo "3. Fixed status mapping in QueueAdminReservationEmails listener\n";
echo "\nNext steps:\n";
echo "- Make sure queue worker is running: php artisan queue:work\n";
echo "- Test by changing a reservation status\n";
echo "- Check logs for any errors\n";
