<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantReservationSlotsSeeder extends Seeder
{
    public function run()
    {
        DB::table('restaurant_reservation_slots')->insert([
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Monday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Tuesday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Wednesday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Thursday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Friday',
                'time_from' => '10:00',
                'time_to' => '23:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Saturday',
                'time_from' => '15:00',
                'time_to' => '00:00',
            ],
            [
                'restaurant_id' => 21,
                'day_of_week' => 'Sunday',
                'time_from' => '15:00',
                'time_to' => '22:00',
            ],
            // add restaurant 2
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Monday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Tuesday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Wednesday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Thursday',
                'time_from' => '10:00',
                'time_to' => '22:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Friday',
                'time_from' => '10:00',
                'time_to' => '23:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Saturday',
                'time_from' => '15:00',
                'time_to' => '00:00',
            ],
            [
                'restaurant_id' => 22,
                'day_of_week' => 'Sunday',
                'time_from' => '15:00',
                'time_to' => '22:00',
            ]
        ]);
    }
}
