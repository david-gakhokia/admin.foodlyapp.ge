<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = [
            [
                'slug' => 'burgers',
                'status' => 'active',
                'rank' => 1,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835443/burger_ylzlhc.png',
                'translations' => [
                    'en' => ['name' => 'Burgers', 'description' => 'Grilled and juicy'],
                    'ka' => ['name' => 'ბურგერები', 'description' => 'შაშხიანი და წვნიანი'],
                ]
            ],
            [
                'slug' => 'pizza',
                'status' => 'active',
                'rank' => 2,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835489/pizza_d7xlgg.png',
                'translations' => [
                    'en' => ['name' => 'Pizza', 'description' => 'Cheesy and delicious'],
                    'ka' => ['name' => 'პიცა', 'description' => 'ყველიანი და გემრიელი'],
                ]
            ],
            [
                'slug' => 'salads',
                'status' => 'active',
                'rank' => 3,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835793/salad_gtponl.png',
                'translations' => [
                    'en' => ['name' => 'Salads', 'description' => 'Fresh and healthy salads'],
                    'ka' => ['name' => 'სალათები', 'description' => 'ახალი და ჯანსაღი სალათები'],
                ]
            ],
            [
                'slug' => 'soups',
                'status' => 'active',
                'rank' => 4,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835680/hot-soup_e4dwth.png',
                'translations' => [
                    'en' => ['name' => 'Soups', 'description' => 'Warm and comforting soups'],
                    'ka' => ['name' => 'სუპები', 'description' => 'თბილი და კომფორტული სუპები'],
                ]
            ],
            [
                'slug' => 'pastries',
                'status' => 'active',
                'rank' => 5,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749836203/pasta_ci54me.png',
                'translations' => [
                    'en' => ['name' => 'Pastries', 'description' => 'Delicious pastries and baked goods'],
                    'ka' => ['name' => 'პასტა', 'description' => 'გემრიელი ცომეული და ნამცხვრები'],
                ]
            ],
            [
                'slug' => 'khinkali',
                'status' => 'active',
                'rank' => 6,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835626/homemade_gbqftn.png',
                'translations' => [
                    'en' => ['name' => 'Khinkali', 'description' => 'Juicy Georgian dumplings'],
                    'ka' => ['name' => 'ხინკალი', 'description' => 'წვნიანი ქართული ხინკალი'],
                ]
            ],
            [
                'slug' => 'khachapuri',
                'status' => 'active',
                'rank' => 7,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835796/food-and-restaurant_kwcvva.png',
                'translations' => [
                    'en' => ['name' => 'Khachapuri', 'description' => 'Cheesy Georgian bread'],
                    'ka' => ['name' => 'ხაჭაპური', 'description' => 'ყველი ქართული პური'],
                ]
            ],
            [
                'slug' => 'fish-and-seafood',
                'status' => 'active',
                'rank' => 8,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749836028/fish_vulwid.png',
                'translations' => [
                    'en' => ['name' => 'Seafood', 'description' => 'Fresh fish and seafood dishes'],
                    'ka' => ['name' => 'თევზეული', 'description' => 'ახალი თევზი და ზღვის კერძები'],
                ]
            ],
            [
                'slug' => 'pasta',
                'status' => 'active',
                'rank' => 9,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749836203/pasta_ci54me.png',
                'translations' => [
                    'en' => ['name' => 'Pasta', 'description' => 'Delicious pasta dishes'],
                    'ka' => ['name' => 'პასტა', 'description' => 'გემრიელი პასტის კერძები'],
                ]
            ],
            [
                'slug' => 'noodles',
                'status' => 'active',
                'rank' => 10,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835965/noodles_k8k7w1.png',
                'translations' => [
                    'en' => ['name' => 'Noodles', 'description' => 'Delicious noodle dishes'],
                    'ka' => ['name' => 'ნუდლები', 'description' => 'გემრიელი ნუდლების კერძები'],
                ]
            ]
        ];

        foreach ($dishes as $data) {
            $dish = Dish::create(collect($data)->except('translations')->toArray());

            foreach ($data['translations'] as $locale => $trans) {
                $dish->translateOrNew($locale)->fill($trans);
            }

            $dish->save();
        }
    }
}
