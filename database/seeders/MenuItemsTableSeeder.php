<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\MenuCategory;

class MenuItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantId = \App\Models\Restaurant::first()?->id;

        // კატეგორიების მოძებნა სახელით
        $coldDishesCategory = MenuCategory::whereHas('translations', function($q) {
            $q->where('name', 'Cold dishes');
        })->first();

        $coffeeCategory = MenuCategory::whereHas('translations', function($q) {
            $q->where('name', 'Coffee & Tea');
        })->first();

        $items = [
            [
                'category' => $coldDishesCategory,
                'data' => [
                    'restaurant_id' => $restaurantId,
                    'slug' => 'khinkali',
                    'image' => null,
                    'image_link' => 'https://th.bing.com/th/id/R.aabce547da72278319cea165bf57d2a7?rik=IgEnsKqslRUiwg&pid=ImgRaw&r=0&sres=1&sresct=1',
                    'unit' => 'piece',
                    'quantity' => 1,
                    'price' => 2.50,
                    'discounted_price' => null,
                    'is_vegan' => false,
                    'is_gluten_free' => false,
                    'calories' => 250,
                    'rank' => 1,
                    'preparation_time' => 15,
                    'available' => true,
                    'status' => 'active',
                    'translations' => [
                        'en' => [
                            'name' => 'Khinkali',
                            'description' => 'Traditional Georgian dumplings',
                            'ingredients' => 'Flour, meat, spices, water',
                            'allergens' => 'Gluten',
                        ],
                        'ka' => [
                            'name' => 'ხინკალი',
                            'description' => 'ქართული ტრადიციული კერძი',
                            'ingredients' => 'ფქვილი, ხორცი, სანელებლები, წყალი',
                            'allergens' => 'გლუტენი',
                        ],
                    ],
                ],
            ],
            [
                'category' => $coffeeCategory,
                'data' => [
                    'restaurant_id' => $restaurantId,
                    'slug' => 'americano',
                    'image' => null,
                    'image_link' => 'https://restaurant.foodly.pro/uploads/products/20250122133700.webp',
                    'unit' => 'cup',
                    'quantity' => 1,
                    'price' => 3.00,
                    'discounted_price' => 2.50,
                    'is_vegan' => true,
                    'is_gluten_free' => true,
                    'calories' => 5,
                    'rank' => 2,
                    'preparation_time' => 5,
                    'available' => true,
                    'status' => 'active',
                    'translations' => [
                        'en' => [
                            'name' => 'Americano',
                            'description' => 'Classic black coffee',
                            'ingredients' => 'Coffee, water',
                            'allergens' => '',
                        ],
                        'ka' => [
                            'name' => 'ამერიკანო',
                            'description' => 'კლასიკური შავი ყავა',
                            'ingredients' => 'ყავა, წყალი',
                            'allergens' => '',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($items as $item) {
            if (!$item['category']) {
                continue;
            }
            $data = $item['data'];
            $translations = $data['translations'];
            unset($data['translations']);

            $menuItem = MenuItem::create(array_merge(
                $data,
                ['menu_category_id' => $item['category']->id]
            ));

            foreach ($translations as $locale => $trans) {
                \DB::table('menu_item_translations')->insert([
                    'menu_item_id' => $menuItem->id,
                    'locale' => $locale,
                    'name' => $trans['name'],
                    'description' => $trans['description'] ?? null,
                    'ingredients' => $trans['ingredients'] ?? null,
                    'allergens' => $trans['allergens'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}