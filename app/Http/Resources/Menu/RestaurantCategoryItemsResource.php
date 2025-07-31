<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RestaurantShortResource;
use App\Http\Resources\Menu\MenuItemResource;
use App\Http\Resources\Menu\MenuCategoryResource;

class RestaurantCategoryItemsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'restaurant' => new RestaurantShortResource($this->resource),
            'category' => new MenuCategoryResource($this->whenLoaded('category')),
            'products' => MenuItemResource::collection($this->whenLoaded('menuItems')),
        ];
    }
}
