<?php

require_once 'vendor/autoload.php';

use App\Models\Dish;
use App\Models\Restaurant;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Find the pizza dish
$dish = Dish::where('slug', 'pizza')->first();
if (!$dish) {
    echo "Pizza dish not found!\n";
    exit(1);
}

// Find the exodus restaurant
$restaurant = Restaurant::where('slug', 'exodus')->first();
if (!$restaurant) {
    echo "Exodus restaurant not found!\n";
    exit(1);
}

// Create the connection
$dish->restaurants()->attach($restaurant->id, [
    'rank' => 1,
    'status' => 'active',
    'created_at' => now(),
    'updated_at' => now()
]);

echo "Successfully connected Pizza dish to Exodus restaurant!\n";
echo "Dish ID: {$dish->id}, Restaurant ID: {$restaurant->id}\n";
