<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
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
                'seats' => $this->seats,
                'image' => $this->image,
                'image_link' => $this->image_link,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'restaurant_id' => $this->restaurant_id,
                'place_id' => $this->place_id,
                'qr_code_image' => $this->qr_code_image,
                'qr_code_link' => $this->qr_code_link,
            ];
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'slug' => $this->slug,
            'seats' => $this->seats,
            'rank' => $this->rank,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'restaurant_id' => $this->restaurant_id,
            'place_id' => $this->place_id,
            'qr_code_image' => $this->qr_code_image,
            'qr_code_link' => $this->qr_code_link,

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
