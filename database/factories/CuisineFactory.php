<?php

namespace Database\Factories;

use App\Models\Cuisine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CuisineFactory extends Factory
{
    protected $model = Cuisine::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word;

        return [
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'rank' => $this->faker->numberBetween(1, 50),
            'image' => null,
            'image_link' => null,
            'icon' => null,
            'icon_link' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Cuisine $cuisine) {
            $cuisine->translateOrNew('en')->fill([
                'name' => 'Cuisine ' . $cuisine->id,
                'description' => 'EN description',
            ]);

            $cuisine->translateOrNew('ka')->fill([
                'name' => 'სამზარეულო ' . $cuisine->id,
                'description' => 'ქართულად აღწერა',
            ]);

            $cuisine->save();
        });
    }
}
