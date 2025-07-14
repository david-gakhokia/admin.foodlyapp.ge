<?php

namespace Tests\Feature;

use App\Models\Space;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpaceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_returns_all_spaces()
    {
        Space::factory()->count(3)->create();

        $response = $this->getJson('/api/spaces');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data')); // ✅ მხოლოდ data მასივის შინაარსი
    }




    public function test_it_returns_single_space_by_slug()
    {
        $space = Space::factory()->create(['slug' => 'romantic']);

        $response = $this->getJson('/api/spaces/romantic');

        $response->assertStatus(200)
            ->assertJsonFragment(['slug' => 'romantic']);
    }

    public function test_it_creates_a_new_space()
    {
        $data = [
            'slug' => 'business',
            'status' => 'active',
            'image' => 'image.jpg',
            'render_image' => 'render.jpg',
            'ka' => [
                'name' => 'ბიზნეს სივრცე',
                'description' => 'შეხვედრებისათვის',
            ],
            'en' => [
                'name' => 'Business Space',
                'description' => 'For meetings',
            ]
        ];

        $response = $this->postJson('/api/spaces', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('spaces', ['slug' => 'business']);
        $this->assertDatabaseHas('space_translations', ['name' => 'ბიზნეს სივრცე']);
    }


    public function test_it_validates_required_fields_on_store()
    {
        $response = $this->postJson('/api/spaces', []);

        $response->assertStatus(422); // Unprocessable Entity
        $response->assertJsonValidationErrors(['slug', 'status', 'ka.name']);
    }


    public function test_it_updates_a_space(): void
    {
        $space = Space::factory()->create(['slug' => 'old-slug']);

        $data = [
            'slug' => 'updated-slug',
            'status' => 'active',
            'image' => 'updated.jpg',
            'image_link' => 'https://example.com/updated.jpg',
            'rank' => 99,
            'ka' => [
                'name' => 'განახლებული სახელი',
                'description' => 'განახლებული აღწერა',
            ],
        ];

        $response = $this->putJson("/api/spaces/{$space->slug}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'slug' => 'updated-slug',
                'status' => 'active',
                'image' => 'updated.jpg',
            ]);

        $this->assertDatabaseHas('spaces', ['slug' => 'updated-slug']);
        $this->assertDatabaseHas('space_translations', [
            'name' => 'განახლებული სახელი',
            'locale' => 'ka',
        ]);
    }


    public function test_it_deletes_a_space(): void
    {
        $space = Space::factory()->create(['slug' => 'to-be-deleted']);

        $response = $this->deleteJson("/api/spaces/{$space->slug}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Space deleted successfully',
            ]);

        $this->assertDatabaseMissing('spaces', ['slug' => 'to-be-deleted']);
    }

    public function test_it_filters_spaces_by_status()
    {
        // შექმენი 1 active და 2 inactive
        Space::factory()->create(['status' => 'active']);
        Space::factory()->count(2)->create(['status' => 'inactive']);

        $response = $this->getJson('/api/spaces?filter[status]=active');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data')); // ✅ მხოლოდ data-ს ვითვლით
        $response->assertJsonFragment(['status' => 'active']);
    }


    public function test_it_searches_spaces_by_name()
    {
        $space = Space::factory()->create(['slug' => 'match-slug']);
        $space->translateOrNew('ka')->name = 'გამორჩეული სივრცე';
        $space->save();

        Space::factory()->count(2)->create(); // noise records

        $response = $this->getJson('/api/spaces?search=გამორჩეული');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
        $response->assertJsonFragment(['slug' => 'match-slug']);
    }



    public function test_it_sorts_spaces_by_rank_desc()
    {
        Space::factory()->create(['slug' => 'first', 'rank' => 1]);
        Space::factory()->create(['slug' => 'second', 'rank' => 10]);

        $response = $this->getJson('/api/spaces?sort=-rank');

        $response->assertStatus(200);
        $this->assertEquals('second', $response->json('data.0.slug'));
    }

    public function test_it_paginates_spaces()
    {
        Space::factory()->count(13)->create();

        $response = $this->getJson('/api/spaces?per_page=5');

        $response->assertStatus(200);
        $this->assertCount(5, $response->json('data'));
    }
}
