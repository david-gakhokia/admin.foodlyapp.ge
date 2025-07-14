<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 *
 * @property int $id
 * @property string $identifier
 * @property string $secret
 * @property string|null $name
 * @property string|null $location
 * @property string $status
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $last_seen
 * @property string $mode
 * @property string|null $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kiosk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kiosk extends Model
{
    use HasApiTokens;

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_OFFLINE = 'offline';
    const STATUS_MAINTENANCE = 'maintenance';

    protected $fillable = [
        'identifier',
        'secret',
        'name',
        'location',
        'status',
        'ip_address',
        'last_seen',
        'mode',
        'content',


    ];

    protected $hidden = [
        'secret',
    ];

    protected $casts = [
        'last_seen' => 'datetime',
    ];

    /**
     * Get all valid status values
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_OFFLINE => 'Offline',
            self::STATUS_MAINTENANCE => 'Maintenance',
        ];
    }

    /**
     * Check if kiosk is active
     */
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Check if kiosk is offline
     */
    public function isOffline()
    {
        return $this->status === self::STATUS_OFFLINE;
    }

    /**
     * Check if kiosk is under maintenance
     */
    public function isUnderMaintenance()
    {
        return $this->status === self::STATUS_MAINTENANCE;
    }



    // თუ გინდა ავტომატურად ჰეშირდეს სეკრეტი
    public function setSecretAttribute($value)
    {
        $this->attributes['secret'] = bcrypt($value);
    }
}
