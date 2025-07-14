<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableReservationSlot extends Model
{
    protected $fillable = [
        'table_id',
        'day_of_week',
        'time_from',
        'time_to',
        'slot_interval_minutes',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
