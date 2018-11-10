<?php

namespace App\Domain\School\Curso;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;
use Webpatser\Uuid\Uuid;

class CursoService
{
    public function getList(Request $request)
    {
        return CursoFilter::seach($request->search)->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        self::validate($request);

        $curso = new Curso();
        $curso->id = Uuid::generate()->string;
        $curso->name = $request->name;
        $curso->media_aprovacao = $request->media_aprovacao;
        $curso->numero_alunos = 0;
        $curso->save();
    }

    public function update(Curso $curso, Request $request)
    {
        self::validate($request);

        $newCurso = Curso::find($curso->id);
        $newCurso->name = $request->name;
        $newCurso->media_aprovacao = $request->media_aprovacao;
        $newCurso->save();
    }

    private function validate(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'media_aprovacao' => 'required|numeric'
        ]);
    }
}