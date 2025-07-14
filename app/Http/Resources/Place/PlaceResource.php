<?php

namespace App\Http\Resources\Place;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Table\TableResource;

class PlaceResource extends JsonResource
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
                'description' => $this->description,
                'image' => $this->image,
                'image_link' => $this->image_link,
                'restaurant_id' => $this->restaurant_id,
                // დაამატე ეს:
                'tables' => TableResource::collection($this->whenLoaded('tables')),

            ];
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'slug' => $this->slug,
            'rank' => $this->rank,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'restaurant_id' => $this->restaurant_id,

            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                    'description' => $tr->description,
                ];
            }),
        ];
    }
}
