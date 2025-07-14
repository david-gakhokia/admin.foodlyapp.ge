<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dish;
use App\Models\MenuCategory;

class CheckDishMenuCategories extends Command
{
    protected $signature = 'check:dish-menu-categories';
    protected $description = 'Check current dishes and menu categories relationships';

    public function handle()
    {
        $this->info('=== CURRENT DISHES ===');
        $dishes = Dish::with('translations')->get();
        foreach ($dishes as $dish) {
            $name = $dish->translate('ka')->name ?? $dish->translate('en')->name ?? 'Unknown';
            $this->line("ID: {$dish->id} - {$name}");
        }

        $this->info("\n=== CURRENT MENU CATEGORIES ===");
        $menuCategories = MenuCategory::with('translations', 'restaurant')->get();
        foreach ($menuCategories as $category) {
            $name = $category->translate('ka')->name ?? $category->translate('en')->name ?? 'Unknown';
            $restaurantName = $category->restaurant ? 
                ($category->restaurant->translate('ka')->name ?? $category->restaurant->translate('en')->name ?? 'Unknown Restaurant') 
                : 'No Restaurant';
            $dishId = $category->dish_id ? "Dish ID: {$category->dish_id}" : 'No Dish';
            $this->line("ID: {$category->id} - {$name} (Restaurant: {$restaurantName}) ({$dishId})");
        }

        $this->info("\n=== MENU CATEGORIES BY DISH ===");
        foreach ($dishes as $dish) {
            $name = $dish->translate('ka')->name ?? $dish->translate('en')->name ?? 'Unknown';
            $categories = $dish->menuCategories()->with('translations', 'restaurant')->get();
            $this->line("Dish: {$name} has {$categories->count()} menu categories:");
            foreach ($categories as $category) {
                $categoryName = $category->translate('ka')->name ?? $category->translate('en')->name ?? 'Unknown';
                $restaurantName = $category->restaurant ? 
                    ($category->restaurant->translate('ka')->name ?? $category->restaurant->translate('en')->name ?? 'Unknown Restaurant') 
                    : 'No Restaurant';
                $this->line("  - {$categoryName} (Restaurant: {$restaurantName})");
            }
        }

        return 0;
    }
}
