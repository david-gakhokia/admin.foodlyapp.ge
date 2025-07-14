<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\Table;
use App\Models\RestaurantReservationSlot;
use App\Models\PlaceReservationSlot;
use App\Models\TableReservationSlot;

class ReservationSlotSeeder extends Seeder
{
    public function run()
    {
        // პირველი რესტორანი ვამოწმებთ არსებობს თუ არა
        $restaurant = Restaurant::first();
        if ($restaurant) {
            RestaurantReservationSlot::create([
                'restaurant_id' => $restaurant->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '10:00:00',
                'end_time' => '22:00:00',
                'slot_interval_minutes' => 60,
                'available' => true
            ]);
        } else {
            $this->command->warn('No restaurant found, skipping RestaurantReservationSlot seed');
        }

        // პირველი სივრცე
        $place = Place::first();
        if ($place) {
            PlaceReservationSlot::create([
                'place_id' => $place->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '12:00:00',
                'end_time' => '20:00:00',
                'slot_interval_minutes' => 30,
                'available' => true
            ]);
        } else {
            $this->command->warn('No place found, skipping PlaceReservationSlot seed');
        }

        // პირველი მაგიდა
        $table = Table::first();
        if ($table) {
            TableReservationSlot::create([
                'table_id' => $table->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true
            ]);
        } else {
            $this->command->warn('No table found, skipping TableReservationSlot seed');
        }


        $restaurantId = 21;

        // Monday
        RestaurantReservationSlot::create([
            'restaurant_id' => $restaurantId,
            'day_of_week' => 'Monday',
            'start_time' => '12:00:00',
            'end_time' => '18:00:00',
            'slot_interval_minutes' => 60,
            'available' => true
        ]);

        // Tuesday
        RestaurantReservationSlot::create([
            'restaurant_id' => $restaurantId,
            'day_of_week' => 'Tuesday',
            'start_time' => '12:00:00',
            'end_time' => '18:00:00',
            'slot_interval_minutes' => 60,
            'available' => true
        ]);
    }
}
