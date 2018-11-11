<?php

namespace App\Domain\School\Curso;

use App\Core\Filter;

class CursoFilter extends Filter
{
    public static function seach($term = '')
    {
        return Curso::where(function ($subquery) use ($term) {
                $subquery
                    ->orWhere('id', 'like', "%{$term}%")
                    ->orWhere('name', 'like', "%{$term}%");
            })
            ->where('deleted', false);
    }
}