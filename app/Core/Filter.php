<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public function apply(Builder $query)
    {
        collect(request('filter', []))
            ->each(function ($filter, $key) use (& $query) {
                if ($filter && method_exists($this, $key)) {
                    $query = $this->{$key}($query, $filter);
                }
            });

        return $query;
    }
}