<?php

namespace App\Domain\Localization\State;

use App\Core\Filter;

class StateFilter extends Filter
{
    public function search($query, $term)
    {
        return $query->where('name', 'like', '%' . $term . '%');
    }

}