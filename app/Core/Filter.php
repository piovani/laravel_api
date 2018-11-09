<?php

namespace App\Core;

abstract class Filter
{
    /**
     * Query order by field name.
     *
     * @var string
     */
    protected $orderKey;

    /**
     * Query order by direction.
     *
     * @var string
     */
    protected $orderDirection;

    /**
     * Query filters values.
     *
     * @var array
     */
    protected $filters;

    /**
     * Allow to set order by.
     *
     * @var boolean
     */
    protected $allowOrder;

    /**
     * Aplly filters to the query.
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @param  array                             $filters
     * @param  boolean                           $order
     * @return Illuminate\Database\Query\Builder
     */
    public function apply($query, array $filters = [], $allowOrder = true)
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

    /**
     * Change the query order field.
     *
     * @param  Illuminate\Database\Query\Builder $query
     * @param  string                            $key
     * @return Illuminate\Database\Query\Builder
     */
    public function order($query, $key)
    {
        if (!$this->allowOrder) {
            return $query;
        }

        $direction = isset($this->filters['direction']) ? $this->filters['direction'] : 'asc';

        return $query->orderByRaw($key.' '.strtoupper($direction));
    }
}
