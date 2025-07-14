<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Space;

class SpaceSeeder extends Seeder
{
    public function run(): void
    {
        $spaces = [
            [
                'slug' => 'romantic-place',
                'rank' => 1,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749837739/31093_uimaun.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Romantic Place',
                        'description' => 'Spacious and modern romantic place.',
                    ],
                    'ka' => [
                        'name' => 'რომანტიკული ადგილი',
                        'description' => 'მდიდარი და თანამედროვე რომანტიკული ადგილი.',
                    ],
                ],
            ],
            [
                'slug' => 'business-lunch',
                'rank' => 2,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749837415/47029_upqzu0.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Business Lunch',
                        'description' => 'Exclusive business lunch area for special guests.',
                    ],
                    'ka' => [
                        'name' => 'ბიზნეს ლანჩი',
                        'description' => 'ექსკლუზიური ბიზნეს ლანჩის სივრცე სპეციალური სტუმრებისთვის.',
                    ],
                ],
            ],
            [
                'slug' => 'city-view',
                'rank' => 3,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749837769/2150820170_vvafpt.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'City View',
                        'description' => 'Beautiful space with city view.',
                    ],
                    'ka' => [
                        'name' => 'ქალაქის ხედით',
                        'description' => 'ლამაზი სივრცე ქალაქის ხედით.',
                    ],
                ],
            ],
            [
                'slug' => 'soccer-environment',
                'rank' => 4,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749837674/2147859710_cqyxh5.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Soccer Environment',
                        'description' => 'Beautiful space with soccer field view.',
                    ],
                    'ka' => [
                        'name' => 'ფეხბურთის გარემო',
                        'description' => 'ლამაზი სივრცე ფეხბურთის მოედნის ხედით.',
                    ],
                ],
            ],
            [
                'slug' => 'family-friendly',
                'rank' => 5,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749837710/2147859710_1_ghqj3b.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Family Friendly',
                        'description' => 'Spacious and modern family-friendly place.',
                    ],
                    'ka' => [
                        'name' => 'საოჯახო სივრცე',
                        'description' => 'მდიდარი და თანამედროვე საოჯახო სივრცე.',
                    ],
                ],
            ],
            [
                'slug' => 'music-environment',
                'rank' => 6,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749839166/65e6882705e29c7066540436_Quaglinos-1024x620_bi1bgs.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Music Environment',
                        'description' => 'Beautiful outdoor garden space.',
                    ],
                    'ka' => [
                        'name' => 'მუსიკალური გარემო',
                        'description' => 'ლამაზი მუსიკალური გარემო.',
                    ],
                ],
            ],
            [
                'slug' => 'events-space',
                'rank' => 7,
                'status' => 'active',
                'image' => null,
                'image_link' => 'https://res.cloudinary.com/dyd5jj9s2/image/upload/v1749839227/10058_q0cta0.jpg',
                'translations' => [
                    'en' => [
                        'name' => 'Events Space',
                        'description' => 'Beautiful outdoor garden space.',
                    ],
                    'ka' => [
                        'name' => 'სადღესასწაულო სივრცე',
                        'description' => 'ლამაზი სადღესასწაულო სივრცე.',
                    ],
                ],
            ],
            
        ];

        foreach ($spaces as $data) {
            $space = Space::create(collect($data)->except('translations')->toArray());

            foreach ($data['translations'] as $locale => $trans) {
                $space->translateOrNew($locale)->fill($trans);
            }

            $space->save();
        }
    }
}
