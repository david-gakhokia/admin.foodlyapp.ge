<?php

namespace App\Http\Resources\Dish;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id' => $this->id,
                'status' => $this->status,
                'rank' => $this->rank,
                'slug' => $this->slug,
                'name' => $this->name,
                'image' => $this->image,
                'image_link' => $this->image_link,
                'icon' => $this->icon,
                'icon_link' => $this->icon_link,
                // 'restaurant_id' => $this->restaurant_id,
                // 'category_id' => $this->category_id,
                'menu_categories' => $this->menuCategories->map(function ($menuCategory) {
                    $restaurant = $menuCategory->restaurant;
                    return [
                        'id' => $menuCategory->id,
                        'slug' => $menuCategory->slug,
                        'name' => $menuCategory->name,
                        'image' => $menuCategory->image,
                        'image_link' => $menuCategory->image_link,
                        'restaurant' => $restaurant ? [
                            'slug' => $restaurant->slug,
                            'name' => $restaurant->name,
                            'logo' => $restaurant->logo,
                        ] : null,
                        'menu_items' => $menuCategory->menuItems->map(function ($item) {
                            $restaurant = $item->restaurant;
                            return [
                                'slug' => $item->slug,
                                'name' => $item->name,
                                'price' => $item->price,
                                'logo' => $restaurant ? $restaurant->logo : null,
                            ];
                        })->values(),
                    ];
                }),
              
            ];
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'slug' => $this->slug,
            'rank' => $this->rank,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'icon' => $this->icon,
            'icon_link' => $this->icon_link,
            // 'restaurant_id' => $this->restaurant_id,
            'category_id' => $this->category_id,
            'menu_categories' => $this->menuCategories->map(function ($menuCategory) {
                return [
                    'id' => $menuCategory->id,
                    'restaurant_id' => $menuCategory->restaurant_id,
                    'slug' => $menuCategory->slug,
                    'rank' => $menuCategory->rank,
                    'status' => $menuCategory->status,
                    'image' => $menuCategory->image,
                    'image_link' => $menuCategory->image_link,
                    'translations' => $menuCategory->translations->map(function ($tr) {
                        return [
                            'locale' => $tr->locale,
                            'name' => $tr->name,
                            'description' => $tr->description,
                        ];
                    }),
                ];
            }),
            'menu_items' => $this->menuCategories->flatMap->menuItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'restaurant_id' => $item->restaurant_id,
                    'category_id' => $item->category_id,
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'price' => $item->price,
                    'image' => $item->image,
                    'image_link' => $item->image_link,
                    'translations' => $item->translations->map(function ($tr) {
                        return [
                            'locale' => $tr->locale,
                            'name' => $tr->name,
                            'description' => $tr->description,
                        ];
                    }),
                ];
            })->values(),
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                ];
            }),
        ];
    }
}
