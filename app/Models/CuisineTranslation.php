<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $cuisine_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereCuisineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CuisineTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CuisineTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
        'meta_title',
        'meta_desc',
    ];
}
