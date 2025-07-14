<?php

namespace App\Http\Resources\Region;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
                'svg' => $this->svg,
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
            'status' => $this->status,
            'image' => $this->image,
            'svg' => $this->svg,
            'translations' => $this->translations->map(function ($tr) {
                return [
                    'locale' => $tr->locale,
                    'name' => $tr->name,
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
