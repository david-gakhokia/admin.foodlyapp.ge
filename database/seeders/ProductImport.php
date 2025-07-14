<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update "locale: en" translations for restaurant_id = 47
        DB::table('product_translations')
            ->where('locale', 'en')
            ->where('restaurant_id', 47)
            ->update([
                'name' => '.',
                'description' => '.',
            ]);

        // Update "locale: ru" translations for restaurant_id = 47
        DB::table('product_translations')
            ->where('locale', 'ru')
            ->where('restaurant_id', 47)
            ->update([
                'name' => '.',
                'description' => '.',
            ]);
    }
}