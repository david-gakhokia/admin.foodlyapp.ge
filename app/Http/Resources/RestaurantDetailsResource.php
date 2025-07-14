<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Place\PlaceResource;

class RestaurantDetailsResource extends JsonResource
{

    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id' => $this->id,
                'slug' => $this->slug,
                'name' => $this->name,
                'description' => $this->description,
                'address' => $this->address,
                'qr_code_image' => $this->qr_code_image,

                'places' => PlaceResource::collection($this->whenLoaded('places')),
            ];
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->resource->getTranslations('name'),
            'description' => $this->resource->getTranslations('description'),
            'address' => $this->resource->getTranslations('address'),
            'qr_code_image' => $this->qr_code_image,

            'places' => PlaceResource::collection($this->whenLoaded('places')),
        ];
    }
}
