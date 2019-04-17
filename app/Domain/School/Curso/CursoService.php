<?php

namespace App\Domain\School\Curso;

use Illuminate\Http\Request;

class CursoService
{
    public function getList(Request $request)
    {
        return CursoFilter::search($request->search)->paginate();
    }

    public function store(Request $request)
    {
        self::validate($request);

        $curso = factory(Curso::class)->create();
        $curso->name = $request->name;
        $curso->media_aprovacao = $request->media_aprovacao;
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