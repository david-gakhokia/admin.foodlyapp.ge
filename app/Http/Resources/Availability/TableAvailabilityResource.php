<?php

namespace App\Http\Resources\Availability;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableAvailabilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'description' => $this->description,
            'seats' => $this->seats,
            'capacity' => $this->capacity,
            'image' => $this->image,
            'reservation_slots' => $this->when(
                $this->relationLoaded('reservationSlots'),
                fn() => $this->reservationSlots->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'day_of_week' => $slot->day_of_week,
                        'time_from' => $slot->time_from,
                        'time_to' => $slot->time_to,
                        'available' => $slot->available,
                        'max_guests' => $slot->max_guests ?? $this->capacity,
                        'slot_interval_minutes' => $slot->slot_interval_minutes,
                    ];
                })
            ),
            'place' => $this->when(
                $this->relationLoaded('place') && $this->place,
                fn() => [
                    'id' => $this->place->id,
                    'name' => $this->place->name,
                    'slug' => $this->place->slug,
                ]
            ),
            'restaurant' => $this->when(
                $this->relationLoaded('restaurant'),
                fn() => [
                    'id' => $this->restaurant->id,
                    'name' => $this->restaurant->name,
                    'slug' => $this->restaurant->slug,
                    'timezone' => $this->restaurant->time_zone ?? 'Asia/Tbilisi',
                ]
            ),
        ];
    }
}
