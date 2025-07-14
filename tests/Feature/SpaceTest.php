<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Space;
use App\Models\SpaceTranslation;

class SpaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_space()
    {
        // Create a space
        $space = Space::create([
            'slug' => 'conference-room',
            'rank' => 1,
            'status' => 'active',
        ]);

        // Assert the space exists in the database
        $this->assertDatabaseHas('spaces', [
            'slug' => 'conference-room',
            'rank' => 1,
            'status' => 'active',
        ]);
    }

    /** @test */

    public function it_can_create_a_space_with_translations()
    {
        // Create a space
        $space = Space::create([
            'slug' => 'conference-room',
            'rank' => 1,
            'status' => 'active',
        ]);

        // Add translations
        $space->translations()->createMany([
            [
                'locale' => 'en', // Ensure locale is provided
                'name' => 'Conference Room',
                'description' => 'A room for conferences',
            ],
            [
                'locale' => 'ka', // Ensure locale is provided
                'name' => 'კონფერენციის ოთახი',
                'description' => 'ოთახი კონფერენციებისთვის',
            ],
        ]);

        // Assert the translations exist in the database
        $this->assertDatabaseHas('space_translations', [
            'space_id' => $space->id,
            'locale' => 'en',
            'name' => 'Conference Room',
        ]);

        $this->assertDatabaseHas('space_translations', [
            'space_id' => $space->id,
            'locale' => 'ka',
            'name' => 'კონფერენციის ოთახი',
        ]);
    }
}
