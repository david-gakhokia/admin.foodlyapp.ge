<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->company;

        return [
            'slug' => Str::slug($name) . '-' . Str::random(5), // უნიკალური slug
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'rank' => $this->faker->numberBetween(1, 100),
            'logo' => null,
            'image' => null,
            'phone' => '+995' . $this->faker->numberBetween(500000000, 599999999),
            'email' => $this->faker->unique()->safeEmail,
            'latitude' => $this->faker->latitude(41.65, 41.75),
            'longitude' => $this->faker->longitude(44.75, 44.85),
            'discount_rate' => $this->faker->randomElement([0, 5, 10, 15, 20]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Restaurant $restaurant) {
            $restaurant->translateOrNew('en')->fill([
                'name' => 'Test Restaurant #' . $restaurant->id,
                'description' => 'Sample description in English.',
                'address' => '123 Test Street',
            ]);

            $restaurant->translateOrNew('ka')->fill([
                'name' => 'ტესტ რესტორანი #' . $restaurant->id,
                'description' => 'სატესტო აღწერა ქართულად.',
                'address' => '123 ტესტის ქუჩა',
            ]);

            $restaurant->save();
        });
    }
}
