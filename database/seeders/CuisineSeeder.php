<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuisine;
use Illuminate\Support\Facades\Schema; 

class CuisineSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // საგარეო გასაღების შემოწმების გამორთვა
        Cuisine::truncate(); // cuisines ცხრილის ყველა არსებული ჩანაწერის წაშლა
        Schema::enableForeignKeyConstraints();  // საგარეო გასაღების შემოწმების ჩართვა

        $cuisines = [
            [
                'slug' => 'georgian',
                'status' => 'active',
                'rank' => 1,
                'image' => '',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/cuisines/1734018728146-georgian.jpg',
                'icon' => null,
                'icon_link' => null,
                'translations' => [
                    'en' => [
                        'name' => 'Georgian',
                        'description' => 'Traditional Georgian cuisine.',
                    ],
                    'ka' => [
                        'name' => 'ქართული',
                        'description' => 'ტრადიციული ქართული სამზარეულო.',
                    ],
                ],
            ],
            [
                'slug' => 'italian',
                'status' => true,
                'rank' => 2,
                'image' => '',
                'image_link' => 'https://c.ndtvimg.com/2021-04/umk8i7ko_pasta_625x300_01_April_21.jpg?im=FaceCrop,algorithm=dnn,width=1200,height=886',
                'icon' => null,
                'icon_link' => null,
                'translations' => [
                    'en' => [
                        'name' => 'Italian',
                        'description' => 'Authentic Italian dishes.',
                    ],
                    'ka' => [
                        'name' => 'იტალიური',
                        'description' => 'ავთენტური იტალიური კერძები.',
                    ],
                ],
            ],

            [
                'slug' => 'asian',
                'status' => true,
                'rank' => 3,
                'image' => '',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/cuisines/1734018979460-Asian.jpeg',
                'icon' => null,
                'icon_link' => null,
                'translations' => [
                    'en' => [
                        'name' => 'Asian',
                        'description' => 'Authentic Asian dishes.',
                    ],
                    'ka' => [
                        'name' => 'აზიური',
                        'description' => 'ავთენტური აზიური კერძები.',
                    ],
                ],
            ],
            [
                'slug' => 'european',
                'status' => true,
                'rank' => 4,
                'image' => '',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/cuisines/1734339408429-European.jpg',
                'icon' => null,
                'icon_link' => null,
                'translations' => [
                    'en' => [
                        'name' => 'European',
                        'description' => 'Diverse European cuisine.',
                    ],
                    'ka' => [
                        'name' => 'ევროპული',
                        'description' => 'მრავალფეროვანი ევროპული სამზარეულო.',
                    ],
                ],
            ],
            [
                'slug' => 'mexican',
                'status' => true,
                'rank' => 5,
                'image' => '',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/cuisines/1734339408429-Mexican.jpg',
                'icon' => null,
                'icon_link' => null,
                'translations' => [
                    'en' => [
                        'name' => 'Mexican',
                        'description' => 'Spicy and flavorful Mexican dishes.',
                    ],
                    'ka' => [
                        'name' => 'მექსიკური',
                        'description' => 'მწარე და არომატული მექსიკური კერძები.',
                    ],
                ],
            ],
        ];

        foreach ($cuisines as $data) {
            $cuisine = Cuisine::create(collect($data)->except('translations')->toArray());

            foreach ($data['translations'] as $locale => $trans) {
                $cuisine->translateOrNew($locale)->fill($trans);
            }

            $cuisine->save();
        }

        // Cuisine::factory()->count(10)->create();
    }
}
