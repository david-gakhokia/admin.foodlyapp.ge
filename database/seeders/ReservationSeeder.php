<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating reservations...');
        
        // შევქმნათ 50 რეზერვაცია ტესტისთვის
        Reservation::factory()->count(50)->create();
        
        $this->command->info('Reservations created successfully!');
    }
}
