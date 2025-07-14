<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        // ეს შეგ აწვდის უბრალოდ data-ს
        return [
            'data' => $this->collection,
        ];
    }
    public function with($request): array
    {
        // pagination მეტა ინფორმაცია
        return [
            'meta' => [
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
                'per_page'     => $this->perPage(),
                'total'        => $this->total(),
            ],
        ];
    }
}
