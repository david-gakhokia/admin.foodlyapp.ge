<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,        // მოდელის Translatable-ის საშუალებით თავდაპირველად მოცემულ ენაზე
            'children' => MenuItemResource::collection($this->children),
            'products' => ProductResource::collection($this->products),
        ];
    }
}
