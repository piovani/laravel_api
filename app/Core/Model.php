<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public function scopeFilter($query, $order = true)
    {
        $filters = request()->all();
        $filterClass = get_class($this) . 'Filter';

        if (count($filters) > 0 && class_exists($filterClass)) {
            $filter = new $filterClass();

            $query = $filter->apply($query, $filters, $order);
        }

        return $query;
    }
}