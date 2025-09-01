<?php

namespace Database\Seeders;

use App\Models\BOGTransaction;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class BOGTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // შევქმნათ რეზერვაციები თუ არ არსებობს
        if (Reservation::count() === 0) {
            $this->call(ReservationSeeder::class);
        }

        // არსებული რეზერვაციების ID-ები
        $reservationIds = Reservation::pluck('id')->toArray();

        if (empty($reservationIds)) {
            $this->command->warn('No reservations found. Creating some first...');
            Reservation::factory()->count(50)->create();
            $reservationIds = Reservation::pluck('id')->toArray();
        }

        $this->command->info('Creating BOG transactions...');

        // ბოლო 30 დღის განმავლობაში გავრცელებული ტრანზაქციები
        foreach ($reservationIds as $reservationId) {
            // 70% ალბათობით შევქმნათ ტრანზაქცია თითოეული რეზერვაციისთვის
            if (rand(1, 100) <= 70) {
                BOGTransaction::factory()
                    ->for(Reservation::find($reservationId))
                    ->create();
            }
        }

        // დამატებითი ტესტ სცენარები
        $this->createSpecificScenarios();

        $this->command->info('BOG transactions created successfully!');
    }

    /**
     * Create specific test scenarios
     */
    private function createSpecificScenarios(): void
    {
        // წარმატებული გადახდები ბოლო 7 დღეში
        BOGTransaction::factory()
            ->count(15)
            ->completed()
            ->recent()
            ->create();

        // მაღალი ღირებულების ტრანზაქციები
        BOGTransaction::factory()
            ->count(5)
            ->completed()
            ->highValue()
            ->create();

        // Failed ტრანზაქციები
        BOGTransaction::factory()
            ->count(8)
            ->failed()
            ->recent()
            ->create();

        // Pending ტრანზაქციები
        BOGTransaction::factory()
            ->count(5)
            ->pending()
            ->create();

        // ძველი წარმატებული ტრანზაქციები (ანალიტიკისთვის)
        BOGTransaction::factory()
            ->count(25)
            ->completed()
            ->state(fn () => [
                'created_at' => fake()->dateTimeBetween('-60 days', '-8 days'),
                'paid_at' => fake()->dateTimeBetween('-60 days', '-8 days'),
            ])
            ->create();
    }
}
