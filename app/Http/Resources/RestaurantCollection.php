<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RestaurantCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'status' => 200,
            'data' => $this->collection->map(function ($restaurant) {
                return [
                    'id' => $restaurant->id,
                    'slug' => $restaurant->slug,
                    'name' => $restaurant->name,
                    'image' => $restaurant->cover,
                    'description' => $restaurant->description,
                    'places' => PlaceResource::collection($restaurant->places),
                ];
            }),
        ];
    }
}
