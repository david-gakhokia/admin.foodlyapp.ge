<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'rank'        => $this->rank,
            'price'       => $this->price,
            'image'       => $this->image,
            'restaurant_id' => $this->restaurant_id,
            'category_id' => $this->category_id,
            'status'      => $this->status,
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
