<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $restaurantId = \App\Models\Restaurant::first()?->id;

        // მთავარი კატეგორიები
        $mainCategories = [
            [
                'key' => 'kitchen',
                'data' => [
                    'restaurant_id' => $restaurantId,
                    'parent_id' => null,
                    'rank' => 1,
                    'slug' => null,
                    'image' => null,
                    'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20240727165307.png',
                    'icon' => null,
                    'icon_link' => null,
                    'status' => 'active',
                    'translations' => [
                        'en' => ['name' => 'Kitchen', 'description' => 'Kitchen section'],
                        'ka' => ['name' => 'სამზარეულო', 'description' => 'სამზარეულოს განყოფილება'],
                    ],
                ],
                'children' => [
                    [
                        'rank' => 1,
                        'image' => 'white-wine.jpg',
                        'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20250219211848.jpg',
                        'icon' => null,
                        'icon_link' => null,
                        'status' => 'active',
                        'translations' => [
                            'en' => ['name' => 'Cold dishes', 'description' => 'Selection of cold dishes'],
                            'ka' => ['name' => 'ცივი კერძები', 'description' => 'ცივი კერძებიების არჩევანი'],
                        ],
                    ],
                    [
                        'rank' => 2,
                        'image' => 'red-wine.jpg',
                        'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20250117204728.webp',
                        'icon' => null,
                        'icon_link' => null,
                        'status' => 'active',
                        'translations' => [
                            'en' => ['name' => 'Pastry', 'description' => 'Selection of pastries'],
                            'ka' => ['name' => 'ცომეული', 'description' => 'ცომეულის არჩევანი'],
                        ],
                    ],
                    [
                        'rank' => 3,
                        'image' => 'desserts.jpg',
                        'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20250117205318.webp',
                        'icon' => null,
                        'icon_link' => null,
                        'status' => 'active',
                        'translations' => [
                            'en' => ['name' => 'Dessert', 'description' => 'Desserts'],
                            'ka' => ['name' => 'დესერტი', 'description' => 'დესერტები'],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'bar',
                'data' => [
                    'restaurant_id' => $restaurantId,
                    'parent_id' => null,
                    'rank' => 2,
                    'slug' => null,
                    'image' => null,
                    'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20240727165300.png',
                    'icon' => null,
                    'icon_link' => null,
                    'status' => 'active',
                    'translations' => [
                        'en' => ['name' => 'Bar', 'description' => 'Bar section'],
                        'ka' => ['name' => 'ბარი', 'description' => 'ბარის განყოფილება'],
                    ],
                ],
                'children' => [
                    [
                        'rank' => 1,
                        'image' => 'appetizers.jpg',
                        'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20250122122733.webp',
                        'icon' => null,
                        'icon_link' => null,
                        'status' => 'active',
                        'translations' => [
                            'en' => ['name' => 'Coffee & Tea', 'description' => 'Start your meal with our coffee and tea selection'],
                            'ka' => ['name' => 'ყავა & ჩაი', 'description' => 'დაიწყეთ თქვენი კვება ჩვენი ყავა და ჩაი არჩევანით'],
                        ],
                    ],
                    [
                        'rank' => 2,
                        'image' => 'beverages.jpg',
                        'image_link' => 'https://restaurant.foodly.pro/uploads/categories/20250122122826.webp',
                        'icon' => null,
                        'icon_link' => null,
                        'status' => 'active',
                        'translations' => [
                            'en' => ['name' => 'Refreshing drinks', 'description' => 'Refreshing drinks to accompany your meal'],
                            'ka' => ['name' => 'გამაგრილებელი სასმელები', 'description' => 'გამაგრილებელი სასმელები თქვენი კვების გასაყოლად'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($mainCategories as $main) {
            // მთავარი კატეგორიის შექმნა
            $category = MenuCategory::create(collect($main['data'])->except('translations')->toArray());
            foreach ($main['data']['translations'] as $locale => $trans) {
                $category->translateOrNew($locale)->fill($trans);
            }
            $category->save();

            // ქვე-კატეგორიების შექმნა
            foreach ($main['children'] as $child) {
                $subcategory = MenuCategory::create([
                    'restaurant_id' => $restaurantId,
                    'parent_id' => $category->id,
                    'rank' => $child['rank'],
                    'slug' => null,
                    'image' => $child['image'],
                    'image_link' => $child['image_link'],
                    'icon' => $child['icon'],
                    'icon_link' => $child['icon_link'],
                    'status' => $child['status'],
                ]);
                foreach ($child['translations'] as $locale => $trans) {
                    $subcategory->translateOrNew($locale)->fill($trans);
                }
                $subcategory->save();
            }
        }
    }
}