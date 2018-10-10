<?php

namespace App\Domain\Localization\State;

use App\Core\Filter;

class StateFilter extends Filter
{
    public function search($query, $term)
    {
        return $query->where(function ($subquery) use ($term) {
            $subquery
                ->where('id', $term)
                ->orWhere('name', 'like', '%' . $term . '%')
                -orWhere('initials', 'like', '%' . $term , '%');
        });
    }
}