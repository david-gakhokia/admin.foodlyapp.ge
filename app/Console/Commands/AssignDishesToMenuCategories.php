<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dish;
use App\Models\MenuCategory;

class AssignDishesToMenuCategories extends Command
{
    protected $signature = 'assign:dishes-to-menu-categories';
    protected $description = 'Assign appropriate dish_id to existing menu categories based on their names';

    public function handle()
    {
        $this->info('=== ASSIGNING DISHES TO MENU CATEGORIES ===');

        // Define mapping based on category names
        $mappings = [
            // Pizza related
            'პიცა' => 5, // პიცა
            'pizza' => 5,
            'pizzas' => 5,
            
            // Burgers related
            'ბურგერები' => 1, // ბურგერები
            'burger' => 1,
            'burgers' => 1,
            'საჭმელები' => 1, // General food can be burgers
            
            // Salads related
            'სალათები' => 3, // სალათები
            'salad' => 3,
            'salads' => 3,
            
            // Noodles/Pasta related
            'ნუდლები' => 2, // ნუდლები
            'noodles' => 2,
            'pasta' => 2,
            'ცომეული' => 2, // ცომეული can be noodles/pasta
            
            // Seafood related
            'თევზეული' => 4, // თევზეული
            'seafood' => 4,
            
            // Coffee related
            'ყავა' => 7, // ყავა
            'coffee' => 7,
            
            // Khachapuri related
            'ხაჭაპური' => 8, // ხაჭაპური
            'khachapuri' => 8,
            
            // Kitchen/Food general
            'სამზარეულო' => 1, // Can be burgers/general food
            
            // Cocktails
            'კოქტეილები' => 6, // კოქტეილი
            'cocktail' => 6,
            'cocktails' => 6,
            
            // Bar/Drinks - no specific dish, leave as null
            'ბარი' => null,
            'სასმელები' => null, // Drinks category
        ];

        $menuCategories = MenuCategory::with('translations')->whereNull('dish_id')->get();
        
        foreach ($menuCategories as $category) {
            $kaName = $category->translate('ka')->name ?? '';
            $enName = $category->translate('en')->name ?? '';
            
            $dishId = null;
            
            // Check Georgian name first
            if ($kaName) {
                $kaLower = mb_strtolower($kaName);
                if (isset($mappings[$kaLower])) {
                    $dishId = $mappings[$kaLower];
                }
            }
            
            // Check English name if no match
            if (!$dishId && $enName) {
                $enLower = strtolower($enName);
                if (isset($mappings[$enLower])) {
                    $dishId = $mappings[$enLower];
                }
            }
            
            // Check partial matches
            if (!$dishId) {
                foreach ($mappings as $keyword => $mapDishId) {
                    if ($keyword && $mapDishId) {
                        if (mb_strpos(mb_strtolower($kaName), $keyword) !== false || 
                            strpos(strtolower($enName), $keyword) !== false) {
                            $dishId = $mapDishId;
                            break;
                        }
                    }
                }
            }
            
            if ($dishId) {
                $category->update(['dish_id' => $dishId]);
                $dish = Dish::find($dishId);
                $dishName = $dish ? ($dish->translate('ka')->name ?? $dish->translate('en')->name) : 'Unknown';
                $this->line("✓ Updated Category '{$kaName}' (ID: {$category->id}) → Dish '{$dishName}' (ID: {$dishId})");
            } else {
                $this->line("- Skipped Category '{$kaName}' (ID: {$category->id}) - no suitable dish found");
            }
        }

        $this->info("\n=== ASSIGNMENT COMPLETE ===");
        return 0;
    }
}
