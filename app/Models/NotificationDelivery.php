<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationDelivery extends Model
{
    protected $fillable = [
        'notification_event_id',
        'recipient_email',
        'recipient_type',
        'template_id',
        'template_data',
        'provider',
        'provider_message_id',
        'status',
        'sent_at',
        'delivered_at',
        'opened_at',
        'clicked_at',
        'error_message',
        'webhook_data',
    ];

    protected $casts = [
        'template_data' => 'array',
        'webhook_data' => 'array',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_OPENED = 'opened';
    const STATUS_CLICKED = 'clicked';
    const STATUS_BOUNCED = 'bounced';
    const STATUS_DROPPED = 'dropped';
    const STATUS_DEFERRED = 'deferred';
    const STATUS_SPAM_REPORT = 'spam_report';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';

    const RECIPIENT_TYPE_CLIENT = 'client';
    const RECIPIENT_TYPE_MANAGER = 'manager';
    const RECIPIENT_TYPE_ADMIN = 'admin';

    public function notificationEvent(): BelongsTo
    {
        return $this->belongsTo(NotificationEvent::class);
    }

    public function updateStatus(string $status, array $webhookData = null): void
    {
        $updates = ['status' => $status];
        
        if ($webhookData) {
            $updates['webhook_data'] = $webhookData;
        }

        switch ($status) {
            case self::STATUS_SENT:
                $updates['sent_at'] = now();
                break;
            case self::STATUS_DELIVERED:
                $updates['delivered_at'] = now();
                break;
            case self::STATUS_OPENED:
                $updates['opened_at'] = now();
                break;
            case self::STATUS_CLICKED:
                $updates['clicked_at'] = now();
                break;
        }

        $this->update($updates);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByRecipientType($query, string $recipientType)
    {
        return $query->where('recipient_type', $recipientType);
    }
}
