<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug,
            'rank' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'space', true),
            'image_link' => $this->faker->url(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
