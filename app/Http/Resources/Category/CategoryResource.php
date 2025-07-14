<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                'restaurant_id' => $this->restaurant_id,
            ];
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'rank' => $this->rank,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'icon' => $this->icon,
            'icon_link' => $this->icon_link,
            'restaurant_id' => $this->restaurant_id,
        
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                ];
            }),
        ];
    }
}
