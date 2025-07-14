<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Spot;

class RestaurantSpotSeeder extends Seeder
{
    public function run(): void
    {
        // ამ Spot-ს ვუკავშირებთ არსებულ რესტორნებს
        // $spot = Spot::whereTranslation('name', 'რესტორანი', 'ka')->first();
        $spot = Spot::whereTranslation('name', 'ბარი', 'ka')->first();


        if (!$spot) {
            $this->command->error('Spot category "რესტორანი" not found.');
            return;
        }

        $existingRestaurantIds = Restaurant::pluck('id')->toArray();

        $pivotData = [];
        $rank = 1;

        foreach ($existingRestaurantIds as $restaurantId) {
            $pivotData[$restaurantId] = [
                'rank' => $rank++,
                'status' => 'active',
            ];
        }

        // ამით ერთბაშად დაუკავშირებს ყველა რესტორანს Spot-ს
        $spot->restaurants()->syncWithoutDetaching($pivotData);
    }
}
