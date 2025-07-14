<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Place;

class PlaceReservationSlotsSeeder extends Seeder
{
    public function run()
    {
        // Find the sushi-bar place
        $sushiBarPlace = Place::where('slug', 'sushi-bar')->first();
        
        if (!$sushiBarPlace) {
            $this->command->error('Sushi bar place not found! Please run PlaceSeeder first.');
            return;
        }

        // Clear existing slots for this place
        DB::table('place_reservation_slots')->where('place_id', $sushiBarPlace->id)->delete();

        DB::table('place_reservation_slots')->insert([
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Monday',
                'time_from' => '10:00',
                'time_to' => '20:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Tuesday',
                'time_from' => '10:00',
                'time_to' => '20:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Wednesday',
                'time_from' => '10:00',
                'time_to' => '20:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Thursday',
                'time_from' => '10:00',
                'time_to' => '20:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Friday',
                'time_from' => '10:00',
                'time_to' => '22:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Saturday',
                'time_from' => '12:00',
                'time_to' => '23:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_id' => $sushiBarPlace->id,
                'day_of_week' => 'Sunday',
                'time_from' => '12:00',
                'time_to' => '20:00',
                'slot_interval_minutes' => 30,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info("Time slots created for Sushi Bar (Place ID: {$sushiBarPlace->id})");
    }
}
