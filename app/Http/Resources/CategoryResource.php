<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // ყველა პანდა ფუნქცია გადავიტანეთ აქ, რადგან app()->getLocale() უკვე აქვს
        return [
            'id'          => $this->id,
            'slug'        => $this->slug,
            'status'      => $this->status,
            'rank'        => $this->rank,
            'image'        => $this->image,
            'parent_id '        => $this->parent_id ,
            'image_svg'        => $this->image_svg,
            'restaurant_id'        => $this->restaurant_id,
            // 'restaurant_id'        => $this->restaurant_id,
            // ჯამში მიაქვს automatic Translatable trait–ის გატანის name და description
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
