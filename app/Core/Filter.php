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
        $this->allowOrder = $allowOrder;
        $this->filters = $filters;

        foreach ($this->filters as $methodName => $filter) {
            if ($filter && method_exists($this, $methodName)) {
                $query = $this->{$methodName}($query, $filter);
            }
        }

        return $query;
    }

    public function sortBy($query, $key)
    {
        if (!$this->allowOrder) {
            return $query;
        }

        $direction = isset($this->filters['descending']) && $this->filters['descending'] == 'true' ? 'desc' : 'asc';

        return $query->orderByRaw($key . ' ' . strtoupper($direction));
    }
}