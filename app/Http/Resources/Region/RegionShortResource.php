<?php

namespace App\Http\Resources\Region;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionShortResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id' => $this->id,
                'rank' => $this->rank,
                'status' => $this->status,
                'slug' => $this->slug,
                'name' => $this->name,
                'image' => $this->image,
                'svg' => $this->svg,
           
            ];
        }

        return [
            'id' => $this->id,
            'rank' => $this->rank,
            'status' => $this->status,
            'slug' => $this->slug,
            'image' => $this->image,
            'svg' => $this->svg,
        
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                ];
            }),
        ];
    }
}
