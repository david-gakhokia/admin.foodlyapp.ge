<?php

// Fix all Mailable classes to include $restaurantName

$mailables = [
    'app/Mail/Admin/AdminPendingEmail.php',
    'app/Mail/Admin/AdminConfirmedEmail.php', 
    'app/Mail/Admin/AdminCompletedEmail.php',
    'app/Mail/Admin/AdminCancelledEmail.php',
    'app/Mail/Client/ClientPendingEmail.php',
    'app/Mail/Client/ClientConfirmedEmail.php',
    'app/Mail/Client/ClientCompletedEmail.php',
    'app/Mail/Client/ClientCancelledEmail.php',
    'app/Mail/Restaurant/RestauranPendingEmail.php',
    'app/Mail/Restaurant/RestaurantConfirmedEmail.php',
    'app/Mail/Restaurant/RestaurantCompletedEmail.php',
    'app/Mail/Restaurant/RestaurantCancelledEmail.php',
];

$constructorPattern = '/public function __construct\(\$reservation\)\s*\{\s*\$this->reservation = \$reservation;\s*\}/';

$newConstructor = 'public function __construct($reservation)
    {
        $this->reservation = $reservation;
        
        // Pre-compute restaurant name safely
        if (method_exists($reservation, \'getRestaurantName\')) {
            $this->restaurantName = $reservation->getRestaurantName();
        } else {
            $this->restaurantName = \'N/A\';
        }
    }';

$propertyPattern = '/public \$reservation;/';
$newProperty = 'public $reservation;
    public $restaurantName;';

$buildPattern = '/->with\(\[\'reservation\' => \$this->reservation\]\);/';
$newBuild = '->with([
                    \'reservation\' => $this->reservation,
                    \'restaurantName\' => $this->restaurantName,
                ]);';

foreach ($mailables as $mailable) {
    if (!file_exists($mailable)) {
        echo "⚠️  File not found: $mailable\n";
        continue;
    }
    
    $content = file_get_contents($mailable);
    $originalContent = $content;
    
    // Add restaurantName property
    $content = preg_replace($propertyPattern, $newProperty, $content);
    
    // Update constructor
    $content = preg_replace($constructorPattern, $newConstructor, $content);
    
    // Update build method
    $content = preg_replace($buildPattern, $newBuild, $content);
    
    if ($content !== $originalContent) {
        file_put_contents($mailable, $content);
        echo "✅ Fixed: $mailable\n";
    } else {
        echo "✓ OK: $mailable\n";
    }
}

echo "\n🎉 All Mailable classes processed!\n";
