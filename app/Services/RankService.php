<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class RankService
{
    /**
     * Get next available rank for a model
     * 
     * @param string|Model $model - Model class or instance
     * @param array $conditions - Optional where conditions
     * @return int
     */
    public function getNextRank($model, array $conditions = []): int
    {
        $modelClass = is_string($model) ? $model : get_class($model);
        
        $query = $modelClass::query();
        
        // Apply conditions if provided (e.g., ['restaurant_id' => 5])
        foreach ($conditions as $field => $value) {
            $query->where($field, $value);
        }
        
        $maxRank = $query->max('rank') ?? 0;
        
        return $maxRank + 1;
    }
    
    /**
     * Auto-assign rank if not provided
     * 
     * @param array $data
     * @param string|Model $model
     * @param array $conditions
     * @return array
     */
    public function assignRankIfEmpty(array $data, $model, array $conditions = []): array
    {
        if (empty($data['rank'])) {
            $data['rank'] = $this->getNextRank($model, $conditions);
        }
        
        return $data;
    }
}
