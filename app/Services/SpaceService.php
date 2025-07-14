<?php

namespace App\Services;

use App\Models\Space;

class SpaceService
{
    public function create(array $data): Space
    {
        $space = Space::create([
            'slug' => $data['slug'],
            'rank' => $data['rank'],
            'image' => $data['image'],
            'image_link' => $data['image_link'],
            'status' => $data['status'],
        ]);

        foreach ($data['translations'] as $locale => $translation) {
            $space->translateOrNew($locale)->name = $translation['name'];
            $space->translateOrNew($locale)->description = $translation['description'];
        }

        $space->save();

        return $space;
    }

    public function update(Space $space, array $data): Space
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        $space->update($data);

        foreach ($translations as $locale => $fields) {
            $space->translateOrNew($locale)->fill($fields);
        }

        $space->save();

        return $space;
    }
}
