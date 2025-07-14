<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'allergens',
    ];
}
