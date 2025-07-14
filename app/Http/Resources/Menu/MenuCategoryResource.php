<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id'            => $this->id,
                'restaurant_id' => $this->restaurant_id,
                'parent_id'     => $this->parent_id,
                'name'          => $this->name,
                'slug'          => $this->slug,
                'image'         => $this->image,
                'image_link'    => $this->image_link,
                'icon'          => $this->icon,
                'icon_link'     => $this->icon_link,
                'rank'          => $this->rank,
                'status'        => $this->status,
                'children'      => MenuCategoryResource::collection($this->whenLoaded('children')),
                'created_at'    => $this->created_at,
                'updated_at'    => $this->updated_at,
            ];
        }

        return [
            'id'            => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'parent_id'     => $this->parent_id,
            'slug'          => $this->slug,
            'image'         => $this->image,
            'image_link'    => $this->image_link,
            'icon'          => $this->icon,
            'icon_link'     => $this->icon_link,
            'rank'          => $this->rank,
            'status'        => $this->status,
            'children'      => MenuCategoryResource::collection($this->whenLoaded('children')),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'translations'  => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name'   => $tr->name,
                    'description'   => $tr->description,
                ];
            }),
        ];
    }


}
