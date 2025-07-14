<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\MenuCategory;

class DishMenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Dish ID-ების მოძებნა
        $allDishes = Dish::all();
        echo "ყველა Dish:\n";
        foreach ($allDishes as $dish) {
            echo "- ID: {$dish->id}, Slug: {$dish->slug}\n";
        }
        echo "\n";

        $pizzaDish = Dish::where('slug', 'pizza')->first();
        $saladsDish = Dish::where('slug', 'salads')->first();
        $pastriesDish = Dish::where('slug', 'pastries')->first();
        $burgersDish = Dish::where('slug', 'burgers')->first();
        $seafoodDish = Dish::where('slug', 'fish-and-seafood')->first();
        $soupsDish = Dish::where('slug', 'soups')->first();
        $khinkaliDish = Dish::where('slug', 'khinkali')->first();
        $khachapuriDish = Dish::where('slug', 'khachapuri')->first();
        $pastaDish = Dish::where('slug', 'pasta')->first();
        $noodlesDish = Dish::where('slug', 'noodles')->first();

        echo "Dish IDs found:\n";
        echo "Pizza: " . ($pizzaDish ? $pizzaDish->id : 'Not found') . "\n";
        echo "Salads: " . ($saladsDish ? $saladsDish->id : 'Not found') . "\n";
        echo "Pastries: " . ($pastriesDish ? $pastriesDish->id : 'Not found') . "\n";
        echo "Burgers: " . ($burgersDish ? $burgersDish->id : 'Not found') . "\n";

        // MenuCategory-ების გაუპდატება dish_id-ით
        $connections = [
            // Restaurant 14
            ['menu_category_id' => 26, 'dish_id' => $saladsDish?->id, 'name' => 'Salads → სალათები'],  // სალათები
            
            // Restaurant 13  
            ['menu_category_id' => 32, 'dish_id' => $pastriesDish?->id, 'name' => 'Pastries → ცომეული'], // ცომეული
            
            // მეტი კავშირების მაგალითები
            ['menu_category_id' => 20, 'dish_id' => $burgersDish?->id, 'name' => 'Burgers → საჭმელები'], // Restaurant 14 - Foods
            ['menu_category_id' => 29, 'dish_id' => $khinkaliDish?->id, 'name' => 'Khinkali → სამზარეულო'], // Restaurant 13 - Kitchen
        ];

        foreach ($connections as $connection) {
            if ($connection['dish_id']) {
                MenuCategory::where('id', $connection['menu_category_id'])
                    ->update(['dish_id' => $connection['dish_id']]);
                    
                echo "✅ Connected: " . $connection['name'] . "\n";
            } else {
                echo "❌ Skipped: " . $connection['name'] . " (Dish not found)\n";
            }
        }

        echo "\n🎉 Dish-MenuCategory connections created!\n";
        echo "\nახლა ტესტი:\n";
        echo "- Pizza dish-ის MenuCategories: " . ($pizzaDish ? $pizzaDish->menuCategories()->count() : 0) . "\n";
        echo "- Salads dish-ის MenuCategories: " . ($saladsDish ? $saladsDish->menuCategories()->count() : 0) . "\n";
        echo "- Pastries dish-ის MenuCategories: " . ($pastriesDish ? $pastriesDish->menuCategories()->count() : 0) . "\n";
    }
}
