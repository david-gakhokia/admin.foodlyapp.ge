<?php

namespace Tests\Feature\Kiosk;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\Table;
use App\Models\RestaurantReservationSlot;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class KioskAvailabilityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $restaurant;
    protected $place;
    protected $table;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a kiosk user for authentication
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        // Create test restaurant
        $this->restaurant = Restaurant::factory()->create([
            'slug' => 'test-restaurant',
            'status' => 'active',
            'time_zone' => 'Asia/Tbilisi'
        ]);

        // Create test place
        $this->place = Place::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'slug' => 'test-place'
        ]);

        // Create test table
        $this->table = Table::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'place_id' => $this->place->id,
            'slug' => 'test-table',
            'capacity' => 4
        ]);

        // Create reservation slots
        RestaurantReservationSlot::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'day_of_week' => 'Monday',
            'time_from' => '10:00:00',
            'time_to' => '22:00:00',
            'available' => true,
            'slot_interval_minutes' => 30,
            'max_guests' => 50
        ]);
    }

    /** @test */
    public function it_can_get_restaurant_availability()
    {
        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'restaurant' => [
                        'id',
                        'name',
                        'slug',
                        'timezone'
                    ],
                    'date',
                    'day_of_week',
                    'available_slots',
                    'weekly_hours'
                ]
            ]);
    }

    /** @test */
    public function it_can_get_restaurant_availability_with_specific_date()
    {
        $date = '2025-07-21'; // Monday

        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}?date={$date}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'date' => $date,
                    'day_of_week' => 'Monday'
                ]
            ]);
    }

    /** @test */
    public function it_can_get_place_availability()
    {
        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}/place/{$this->place->slug}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'restaurant' => [
                        'id',
                        'name',
                        'slug'
                    ],
                    'place' => [
                        'id',
                        'name',
                        'slug'
                    ],
                    'date',
                    'day_of_week',
                    'available_slots',
                    'weekly_hours'
                ]
            ]);
    }

    /** @test */
    public function it_can_get_table_availability()
    {
        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}/place/{$this->place->slug}/table/{$this->table->slug}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'restaurant' => [
                        'id',
                        'name',
                        'slug'
                    ],
                    'place' => [
                        'id',
                        'name',
                        'slug'
                    ],
                    'table' => [
                        'id',
                        'name',
                        'slug',
                        'capacity',
                        'seats'
                    ],
                    'date',
                    'day_of_week',
                    'available_slots',
                    'weekly_hours'
                ]
            ]);
    }

    /** @test */
    public function it_can_get_direct_table_availability()
    {
        // Create a direct table (without place)
        $directTable = Table::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'place_id' => null, // Direct table
            'slug' => 'direct-table',
            'capacity' => 2
        ]);

        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}/table/{$directTable->slug}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'restaurant' => [
                        'id',
                        'name',
                        'slug'
                    ],
                    'table' => [
                        'id',
                        'name',
                        'slug',
                        'capacity',
                        'seats'
                    ],
                    'date',
                    'day_of_week',
                    'available_slots',
                    'weekly_hours'
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    'place'
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_restaurant()
    {
        $response = $this->getJson('/api/kiosk/availability/restaurant/non-existent-restaurant');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'error' => 'Restaurant not found'
            ]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_place()
    {
        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}/place/non-existent-place");

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'error' => 'Restaurant or Place not found'
            ]);
    }

    /** @test */
    public function it_returns_404_for_non_existent_table()
    {
        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}/place/{$this->place->slug}/table/non-existent-table");

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'error' => 'Restaurant, Place or Table not found'
            ]);
    }

    /** @test */
    public function it_requires_authentication()
    {
        // Create a new test instance without authentication
        $response = $this->withoutMiddleware([])->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}");

        // The sanctum middleware should still apply and return 401
        $response->assertStatus(401);
    }

    /** @test */
    public function it_only_shows_active_restaurants()
    {
        // Set restaurant as inactive
        $this->restaurant->update(['status' => 'inactive']);

        $response = $this->getJson("/api/kiosk/availability/restaurant/{$this->restaurant->slug}");

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'error' => 'Restaurant not found'
            ]);
    }
}
