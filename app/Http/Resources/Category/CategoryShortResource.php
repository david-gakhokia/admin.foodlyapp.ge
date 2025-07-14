<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryShortResource extends JsonResource
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
            ];
        }

        return [
            'id' => $this->id,
            'rank' => $this->rank,
            'status' => $this->status,
            'slug' => $this->slug,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'icon' => $this->icon,
            'icon_link' => $this->icon_link,

            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                ];
            }),
        ];
    }
}
