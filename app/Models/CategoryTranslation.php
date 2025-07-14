<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryTranslation extends Model
{
    public $timestamps = false;   // თუ თქვენს მიგრაციაში timestamps გამორთული გაქვთ
    protected $fillable = ['name', 'description'];
}
