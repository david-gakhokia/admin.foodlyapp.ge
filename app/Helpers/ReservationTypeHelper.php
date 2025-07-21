<?php

namespace App\Helpers;

class ReservationTypeHelper
{
    public const RESTAURANT = 'Restaurant';
    public const PLACE = 'Place';
    public const TABLE = 'Table';

    /**
     * Get all available reservation types
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::RESTAURANT,
            self::PLACE,
            self::TABLE,
        ];
    }

    /**
     * Check if value is valid reservation type
     *
     * @param string|null $value
     * @return bool
     */
    public static function isValid(?string $value): bool
    {
        return in_array($value, self::all(), true);
    }
}
