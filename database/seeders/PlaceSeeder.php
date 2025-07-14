<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = \App\Models\Restaurant::all();
        
        $placeTemplates = [
            [
                'status' => 'active',
                'rank' => 1,
                'slug' => 'main-hall',
                'qr_code' => 'QR' . strtoupper(\Illuminate\Support\Str::random(8)),
                'qr_code_image' => "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://foodly.pro/place/main-hall",
                'qr_code_link' => "https://foodly.pro/booking-form/place/main-hall",
                'image' => 'main.jpg',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/places/1734521601489-main%20Hall.jpg',
                'translations' => [
                    'ka' => [
                        'name' => 'მთავარი დარბაზი',
                        'description' => 'ფართო და ნათელი სივრცე',
                    ],
                    'en' => [
                        'name' => 'Main Hall',
                        'description' => 'Spacious and bright area',
                    ],
                ],
            ],
            [
                'status' => 'active',
                'rank' => 2,
                'slug' => 'terrace',
                'qr_code' => 'QR' . strtoupper(\Illuminate\Support\Str::random(8)),
                'qr_code_image' => "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://foodly.pro/place/terrace",
                'qr_code_link' => "https://foodly.pro/booking-form/place/terrace",
                'image' => 'main.jpg',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/places/1734521653131-%E1%83%A2%E1%83%94%E1%83%A0%E1%83%90%E1%83%A1%E1%83%90.jpg',
                'translations' => [
                    'ka' => [
                        'name' => 'ტერასა',
                        'description' => 'ტერასა ტბის ხედით',
                    ],
                    'en' => [
                        'name' => 'Terrace',
                        'description' => 'Terrace with lake view',
                    ],
                ],
            ],
            [
                'status' => 'active',
                'rank' => 3,
                'slug' => 'vip',
                'qr_code' => 'QR' . strtoupper(\Illuminate\Support\Str::random(8)),
                'qr_code_image' => "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://foodly.pro/place/vip",
                'qr_code_link' => "https://foodly.pro/booking-form/place/vip",
                'image' => 'main.jpg',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/places/1734521781380-VIP.jpg',
                'translations' => [
                    'ka' => [
                        'name' => 'VIP დარბაზი',
                        'description' => 'VIP სივრცე',
                    ],
                    'en' => [
                        'name' => 'VIP Hall',
                        'description' => 'VIP area',
                    ],
                ],
            ],
            [
                'status' => 'active',
                'rank' => 4,
                'slug' => 'sushi-bar',
                'qr_code' => 'QR' . strtoupper(\Illuminate\Support\Str::random(8)),
                'qr_code_image' => "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://foodly.pro/place/sushi-bar",
                'qr_code_link' => "https://foodly.pro/booking-form/place/sushi-bar",
                'image' => 'main.jpg',
                'image_link' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/places/1734521841380-Sushi%20Bar.png',
                'translations' => [
                    'ka' => [
                        'name' => 'სუში ბარი',
                        'description' => 'სუში ბარი',
                    ],
                    'en' => [
                        'name' => 'Sushi Bar',
                        'description' => 'Sushi Bar',
                    ],
                ],
            ],
        ];

        // Create places for each restaurant
        foreach ($restaurants as $restaurant) {
            foreach ($placeTemplates as $index => $template) {
                $placeData = $template;
                $placeData['restaurant_id'] = $restaurant->id;
                $placeData['slug'] = $restaurant->slug . '-' . $template['slug'];
                
                $place = \App\Models\Place::create(collect($placeData)->except('translations')->toArray());

                foreach ($placeData['translations'] as $locale => $trans) {
                    $place->translateOrNew($locale)->fill($trans);
                }

                $place->save();
            }
        }
    }
}
