<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;

class RestaurantCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_restaurant_can_be_created_updated_and_deleted(): void
    {
        // Create
        $restaurant = Restaurant::create([
            'slug' => 'test-restaurant',
            'status' => true,
            'rank' => 1,
            'logo' => null,
            'image' => null,
            'phone' => '+995599000000',
            'email' => 'info@test.com',
            'latitude' => 41.7151,
            'longitude' => 44.8271,
            'discount_rate' => 10,
        ]);

        $restaurant->translateOrNew('en')->name = 'Test Restaurant';
        $restaurant->translateOrNew('en')->description = 'English description';
        $restaurant->translateOrNew('en')->address = 'Main Street 1';

        $restaurant->translateOrNew('ka')->name = 'ტესტ რესტორანი';
        $restaurant->translateOrNew('ka')->description = 'ქართულად აღწერა';
        $restaurant->translateOrNew('ka')->address = 'მთავარი ქუჩა 1';

        $restaurant->save();

        $this->assertDatabaseHas('restaurants', ['slug' => 'test-restaurant']);
        $this->assertDatabaseHas('restaurant_translations', ['locale' => 'en', 'name' => 'Test Restaurant']);
        $this->assertDatabaseHas('restaurant_translations', ['locale' => 'ka', 'name' => 'ტესტ რესტორანი']);

        // Update
        $restaurant->update(['slug' => 'updated-restaurant']);
        $restaurant->translate('en')->name = 'Updated Name';
        $restaurant->save();

        $this->assertDatabaseHas('restaurants', ['slug' => 'updated-restaurant']);
        $this->assertDatabaseHas('restaurant_translations', ['locale' => 'en', 'name' => 'Updated Name']);

        // Delete
        $restaurant->delete();

        $this->assertDatabaseMissing('restaurants', ['slug' => 'updated-restaurant']);
        $this->assertDatabaseMissing('restaurant_translations', ['locale' => 'en', 'name' => 'Updated Name']);
    }
}
