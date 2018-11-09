<?php

namespace App\Domain\School\Curso;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class CursoService
{
    public function getList(Request $request)
    {
        return CursoFilter::seach($request->search)->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        $curso = new Curso();
        $curso->id = Uuid::generate()->string;
        $curso->name = $request->name;
        $curso->media_aprovacao = $request->media_aprovacao;
        $curso->numero_alunos = $request->numero_alunos;
        $curso->save();
    }

    public function update(Curso $curso, Request $request)
    {
        $newCurso = Curso::find($curso->id);
        $newCurso->name = $request->name;
        $newCurso->media_aprovacao = $request->media_aprovacao;
        $newCurso->numero_alunos = $request->numero_alunos;
        $newCurso->save();
    }
}