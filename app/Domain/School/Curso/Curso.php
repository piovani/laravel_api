<?php

namespace App\Domain\School\Curso;

use App\Domain\School\Aluno\Aluno;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $incrementing = false;


    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
