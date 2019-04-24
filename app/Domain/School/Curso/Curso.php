<?php

namespace App\Domain\School\Curso;

use App\Domain\School\Aluno\Aluno;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'name',
        'media_aprovacao',
        'numero_alunos',
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
