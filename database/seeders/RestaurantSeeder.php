<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Cuisine;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ხელით დამატებული კონკრეტული რესტორანი
        $restaurants = [];
        for ($i = 1; $i <= 5; $i++) {
            $restaurants[] = [
                'slug' => 'rest-' . Str::random(4),
                'qr_code' => 'QR' . strtoupper(Str::random(8)),
                'qr_code_image' => "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://foodly.pro/rest-" . Str::random(4),
                'qr_code_link' => "https://foodly.pro/booking-form/rest-" . Str::random(4),
                'time_zone' => 'Asia/Tbilisi',
                'status' => 'active',
                'rank' => $i,
                'logo' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/restaurants/1734521487451-logo.png',
                'image' => 'https://foodly.fra1.cdn.digitaloceanspaces.com/restaurants/1734521487517-cover.jpg',
                'video' => 'https://www.youtube.com/embed/pz-eWteo4Rw?si=YrvTt55p9AUtJF-l',
                'phone' => '+99551408220' . $i,
                'whatsapp' => '+99551408220' . $i,
                'email' => "exodus{$i}@foodly.com.ge",
                'website' => "http://www.exodusrestaurant{$i}.com",
                'discount_rate' => rand(10, 30),
                'map_link' => 'https://maps.app.goo.gl/nnpVtm5TBdwhaKYX9',
                'latitude' => '41.64074' . $i,
                'longitude' => '41.61083' . $i,
                'price_per_person' => rand(30, 100) . '₾',
                'working_hours' => '10:00 - 23:00',
                'delivery_time' => rand(20, 40),
                'map_embed_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28978697.826078452!2d18.49043837121392!3d27.548892232987846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406787193beaf967%3A0x75f44586c0ed0c08!2sEXODUS!5e0!3m2!1ska!2sge!4v1704409030659!5m2!1ska!2sge',
                'reservation_type' => collect(['Table', 'Place', 'Yes', 'No'])->random(),
                'created_by' => 1, // Admin user
                'updated_by' => 1,
                'version' => 1,
                'translations' => [
                    'en' => [
                        'name' => "Exodus {$i}",
                        'description' => "Exodus restaurant {$i} for demo purposes",
                        'address' => "Batumi, Khimshiashvili {$i}",
                    ],
                    'ka' => [
                        'name' => "ექსოდუსი {$i}",
                        'description' => "ექსოდუსი რესტორანი {$i} დემოსთვის",
                        'address' => "ბათუმი , ხიმშიაშვილის {$i}",
                    ],
                ],
            ];
        }

        foreach ($restaurants as $data) {
            $restaurant = Restaurant::create(collect($data)->except('translations')->toArray());

            foreach ($data['translations'] as $locale => $trans) {
                $restaurant->translateOrNew($locale)->fill($trans);
            }

            $restaurant->save();
        }

        // 2. 100 სატესტო ჩანაწერი Factory-ით
        // Restaurant::factory()->count(10)->create();

        // 3. cuisine-ების მიბმა თითო რესტორანს (random 2)
        $allCuisineIds = Cuisine::pluck('id')->toArray();

        Restaurant::all()->each(function ($restaurant) use ($allCuisineIds) {
            $cuisineIds = collect($allCuisineIds)->random(2);

            $pivotData = [];
            foreach ($cuisineIds as $id) {
                $pivotData[$id] = [
                    'rank' => rand(1, 5),
                    'status' => 'active',
                ];
            }

            $restaurant->cuisines()->syncWithoutDetaching($pivotData);
        });
    }
}
