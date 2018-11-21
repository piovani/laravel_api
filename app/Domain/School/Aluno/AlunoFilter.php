<?php

namespace App\Domain\School\Aluno;

use App\Core\Filter;

class AlunoFilter extends Filter
{
    public static function seach($term = '')
    {
        return Aluno::where(function ($query) use ($term) {
            $query
                ->orWhere('name', 'like', "%{$term}%" )
                ->orWhere('cpf', 'like', "%{$term}%" );
        })
            ->where('deleted', false);
    }
}