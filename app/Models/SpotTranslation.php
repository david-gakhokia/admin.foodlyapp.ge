<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $spot_id
 * @property string $locale
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereSpotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SpotTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SpotTranslation extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];
}
