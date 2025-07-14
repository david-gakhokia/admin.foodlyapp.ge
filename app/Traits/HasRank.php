<?php

namespace App\Traits;

trait HasRank
{
    /**
     * Boot the trait - auto-assign rank if not provided
     */
    protected static function bootHasRank()
    {
        static::creating(function ($model) {
            if (empty($model->rank)) {
                $model->rank = static::getNextRank();
            }
        });
    }
    
    /**
     * Get the next available rank
     * 
     * @param array $conditions
     * @return int
     */
    public static function getNextRank(array $conditions = []): int
    {
        $query = static::query();
        
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        
        return ($query->max('rank') ?? 0) + 1;
    }
    
    /**
     * Scope for ordering by rank
     */
    public function scopeOrderByRank($query, string $direction = 'asc')
    {
        return $query->orderBy('rank', $direction);
    }
}
