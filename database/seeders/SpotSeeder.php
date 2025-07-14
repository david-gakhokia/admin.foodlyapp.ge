<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Spot;

class SpotSeeder extends Seeder
{
    public function run(): void
    {
        $spots = [
            [
                'slug' => 'restaurant',
                'status' => 'active',
                'rank' => 1,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749834969/restaurant_jgekqf.png',
                'translations' => [
                    'en' => ['name' => 'Restaurant'],
                    'ka' => ['name' => 'რესტორანი'],
                ]
            ],
            [
                'slug' => 'bar',
                'status' => 'active',
                'rank' => 2,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749834998/bar-counter_vb7kop.png',
                'translations' => [
                    'en' => ['name' => 'Bar'],
                    'ka' => ['name' => 'ბარი'],
                ]
            ],
            [
                'slug' => 'cafe',
                'status' => 'active',
                'rank' => 3,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749834846/coffee_jarpl5.png',
                'translations' => [
                    'en' => ['name' => 'Cafe'],
                    'ka' => ['name' => 'კაფე'],
                ]
            ],
            [
                'slug' => 'club',
                'status' => 'active',
                'rank' => 4,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835304/dj-controller_sszuua.png',
                'translations' => [
                    'en' => ['name' => 'Club'],
                    'ka' => ['name' => 'კლუბი'],
                ]
            ],
            [
                'slug' => 'karaoke',
                'status' => 'inactive',
                'rank' => 5,
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749835179/mic_hutp6n.png',
                'translations' => [
                    'en' => ['name' => 'Karaoke'],
                    'ka' => ['name' => 'კარაოკე'],
                ]
            ],
        ];

        foreach ($spots as $data) {
            $spot = Spot::create(collect($data)->except('translations')->toArray());

            foreach ($data['translations'] as $locale => $trans) {
                $spot->translateOrNew($locale)->fill($trans);
            }

            $spot->save();
        }
    }
}