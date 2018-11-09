<?php

namespace App\Domain\School\Curso;

use http\Env\Request;

class CursoService
{
    public function update(Curso $curso, Request $request)
    {
        $curso = Curso::find($curso->id);
        $curso->name = $request->name;
        $curso->media_aprovacao = $request->media_aprovacao;
        $curso->numero_alunos = $request->numero_alunos;
        $curso->save();
    }
}