<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    protected $fillable = [
        'event_key',
        'recipient_type',
        'provider',
        'provider_template_id',
        'subject_template',
        'default_data',
        'is_active',
    ];

    protected $casts = [
        'default_data' => 'array',
        'is_active' => 'boolean',
    ];

    const PROVIDER_SENDGRID = 'sendgrid';
    const PROVIDER_SES = 'ses';

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForEvent($query, string $eventKey, string $recipientType)
    {
        return $query->where('event_key', $eventKey)
                     ->where('recipient_type', $recipientType);
    }

    public static function findTemplate(string $eventKey, string $recipientType, string $provider = self::PROVIDER_SENDGRID): ?self
    {
        return static::active()
            ->forEvent($eventKey, $recipientType)
            ->where('provider', $provider)
            ->first();
    }
}
