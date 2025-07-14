<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityTranslation query()
 * @mixin \Eloquent
 */
class CityTranslation extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    
}
