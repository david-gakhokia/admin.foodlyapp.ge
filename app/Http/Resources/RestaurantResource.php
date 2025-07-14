<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = $request->query('locale');

        if ($locale) {
            app()->setLocale($locale);

            return [
                'id' => $this->id,
                'slug' => $this->slug,
                'logo' => $this->logo,
                'image' => $this->image,
                'video' => $this->video,
                'name' => $this->name,
                'description' => $this->description,
                'address' => $this->address,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'email' => $this->email,
                'website' => $this->website,
                'discount_rate' => $this->discount_rate,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'working_hours' => $this->working_hours,
                'map_link' => $this->map_link,
                'delivery_time' => $this->delivery_time,
                'map_embed_link' => $this->map_embed_link,
                'price_per_person' => $this->price_per_person,
                'reservation_type' => $this->reservation_type,
                'qr_code_image' => $this->qr_code_image,

                // 'status' => $this->status,
                // 'active' => $this->active,
                // 'places' => $this->places->map(function ($place) use ($locale) {
                //     return [
                //         'id' => $place->id,
                //         'image' => $place->image,
                //         'render_image' => $place->render_image,
                //         'rank' => $place->rank,
                //         'name' => $place->translate($locale)?->name,
                //         'description' => $place->translate($locale)?->description,
                //     ];
                // }),
            ];
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'logo' => $this->logo,
            'image' => $this->image,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'website' => $this->website,
            'discount_rate' => $this->discount_rate,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'working_hours' => $this->working_hours,
            'map_link' => $this->map_link,
            'delivery_time' => $this->delivery_time,
            'map_embed_link' => $this->map_embed_link,
            'price_per_person' => $this->price_per_person,
            'reservation_type' => $this->reservation_type,
            'qr_code_image' => $this->qr_code_image,    
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
                    'description' => $tr->description,
                    'address' => $tr->address,
                ];
            }),
            // 'places' => $this->places->map(function ($place) {
            //     return [
            //         'id' => $place->id,
            //         'image' => $place->image,
            //         'render_image' => $place->render_image,
            //         'rank' => $place->rank,
            //         'translations' => $place->translations->map(function ($tr) {
            //             return [
            //                 'locale' => $tr->locale,
            //                 'name' => $tr->name,
            //                 'description' => $tr->description,
            //             ];
            //         }),
            //     ];
            // }),
        ];
    }
}
