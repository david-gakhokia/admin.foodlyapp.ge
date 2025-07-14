<?php

namespace App\Http\Resources\City;

use Illuminate\Http\Resources\Json\JsonResource;

class CityShortResource extends JsonResource
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
                // 'description' => $this->description,
                'image' => $this->image,
                // 'svg' => $this->svg,
        
            ];
        }

        return [
            'id' => $this->id,
            'rank' => $this->rank,
            'status' => $this->status,
            'slug' => $this->slug,
            'image' => $this->image,
            // 'svg' => $this->svg,
        
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                    // 'description' => $tr->description,
                ];
            }),
        ];
    }
}
