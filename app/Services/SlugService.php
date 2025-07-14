<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SlugService
{

    public function generate(Model $model, string $baseString, string $column = 'slug'): string
    {
        $baseSlug = Str::slug($baseString);
        $slug = $baseSlug;
        $counter = 1;

        // Check uniqueness within given model + column
        while ($model->newQuery()->where($column, $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function generateForUpdate(Model $model, string $baseString, int $excludeId, string $column = 'slug'): string
    {
        $baseSlug = Str::slug($baseString);
        $slug = $baseSlug;
        $counter = 1;

        // Check uniqueness excluding current record
        while ($model->newQuery()->where($column, $slug)->where('id', '!=', $excludeId)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
