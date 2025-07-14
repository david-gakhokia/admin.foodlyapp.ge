<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $dish_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DishTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
