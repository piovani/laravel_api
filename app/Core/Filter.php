<?php

namespace App\Core;

abstract class Filter
{
    protected $orderKey;
    protected $orderDirection;
    protected $filters;
    protected $allowOrder;

    public function apply($query, array $filters = [], $allowOrder)
    {
        if (!$this->allowOrder) {
            return $query;
        }

        $direction = isset($this->filters['descending']) && $this->filters['descending'] == 'true' ? 'desc' : 'asc';

        return $query->orderByRaw($key.' '.strtoupper($direction));
    }
}