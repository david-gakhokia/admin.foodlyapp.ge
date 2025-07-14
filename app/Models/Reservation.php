<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'id',
        'type',
        'reservable_type',
        'reservable_id',
        'reservation_date',
        'time_from',
        'time_to',
        'guests_count',
        'name',
        'phone',
        'email',
        'promo_code',
        'notes',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'time_from' => 'datetime:H:i',
        'time_to' => 'datetime:H:i',
        'guests_count' => 'integer',
    ];

    // public function restaurant()
    // {
    //     return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id');
    // }

    // public function place()
    // {
    //     return $this->belongsTo(\App\Models\Place::class, 'place_id');
    // }

    // public function table()
    // {
    //     return $this->belongsTo(\App\Models\Table::class, 'table_id');
    // }

    public function reservable()
    {
        return $this->morphTo();
    }
}
