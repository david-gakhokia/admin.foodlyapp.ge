<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableReservationSlotsSeeder extends Seeder
{
    public function run()
    {
        // Find the first available table
        $table = \App\Models\Table::first();
        
        if (!$table) {
            $this->command->error('No tables found! Please run TableSeeder first.');
            return;
        }

        // Clear existing slots for this table
        DB::table('table_reservation_slots')->where('table_id', $table->id)->delete();

        $slots = [

            [
                'table_id' => $table->id,
                'day_of_week' => 'Monday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Tuesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Wednesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Thursday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Friday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Saturday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => $table->id,
                'day_of_week' => 'Sunday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => false,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Monday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Tuesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Wednesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Thursday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Friday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Saturday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 7,
                'day_of_week' => 'Sunday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => false,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Monday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Tuesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Wednesday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Thursday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Friday',
                'time_from' => '09:00:00',
                'time_to' => '18:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Saturday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => true,
            ],
            [
                'table_id' => 8,
                'day_of_week' => 'Sunday',
                'time_from' => '10:00:00',
                'time_to' => '15:00:00',
                'slot_interval_minutes' => 60,
                'available' => false,
            ],
        ];

        foreach ($slots as $slot) {
            DB::table('table_reservation_slots')->updateOrInsert(
                [
                    'table_id' => $slot['table_id'],
                    'day_of_week' => $slot['day_of_week'],
                    'time_from' => $slot['time_from'],
                    'time_to' => $slot['time_to'],
                ],
                $slot
            );
        }

        $this->command->info("Time slots created for Table ID: {$table->id} ({$table->name})");
    }
}
