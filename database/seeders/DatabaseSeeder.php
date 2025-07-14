<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            KioskSeeder::class,
            CuisineSeeder::class,
            RestaurantSeeder::class,
            PlaceSeeder::class,
            MenuCategorySeeder::class,
            MenuItemsTableSeeder::class,
            SpaceSeeder::class,
            DishSeeder::class,
            SpotSeeder::class,
            // TableSeeder::class,
            // CategorySeeder::class,

        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
