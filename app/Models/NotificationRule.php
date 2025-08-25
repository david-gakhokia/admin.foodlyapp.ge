<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRule extends Model
{
    protected $fillable = [
        'event_key',
        'recipient_type',
        'conditions',
        'delay_minutes',
        'is_active',
    ];

    protected $casts = [
        'conditions' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForEvent($query, string $eventKey)
    {
        return $query->where('event_key', $eventKey);
    }

    public static function getRulesForEvent(string $eventKey): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()
            ->forEvent($eventKey)
            ->get();
    }

    public function shouldSend(array $context = []): bool
    {
        if (empty($this->conditions)) {
            return true;
        }

        // Add logic here to evaluate conditions against context
        // For now, return true
        return true;
    }
}
