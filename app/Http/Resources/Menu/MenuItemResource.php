<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{

    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id'            => $this->id,
                'restaurant_id' => $this->restaurant_id,
                'name'          => $this->name,
                'slug'          => $this->slug,
                'image'         => $this->image,
                'image_link'    => $this->image_link,
                'rank'          => $this->rank,
                'status'        => $this->status,
                'unit'          => $this->unit,
                'quantity'      => $this->quantity,
                'price'         => $this->price,
                'discounted_price' => $this->discounted_price,
                'is_vegan'      => $this->is_vegan,
                'is_gluten_free' => $this->is_gluten_free,
                'calories'      => $this->calories,
                'preparation_time' => $this->preparation_time,
                'available'     => $this->available,

            ];
        }

        return [
            'id'            => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'slug'          => $this->slug,
            'image'         => $this->image,
            'image_link'    => $this->image_link,
            'rank'          => $this->rank,
            'unit'          => $this->unit,
            'quantity'      => $this->quantity,
            'price'         => $this->price,
            'discounted_price' => $this->discounted_price,
            'is_vegan'      => $this->is_vegan,
            'is_gluten_free' => $this->is_gluten_free,
            'calories'      => $this->calories,
            'preparation_time' => $this->preparation_time,
            'available'     => $this->available,
            'status'        => $this->status,
            'translations'  => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name'   => $tr->name,
                    'description'   => $tr->description,
                    'ingredients'   => $tr->ingredients,
                    'allergens'     => $tr->allergens,
                ];
            }),
        ];
    }
}
