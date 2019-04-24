<?php

namespace App\Domain\School\Curso;

use App\Http\Controllers\Controller;
use App\Domain\School\Curso\CursoResource;
use App\Domain\School\Curso\CursoRequest;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        return CursoResource::collection(
            Curso::where('name', 'like', "%{$request->search}%")
                ->paginate()
        );
    }

    public function store(CursoRequest $cursoRequest)
    {
        $curso = factory(Curso::class)->create([
            'name'            => $cursoRequest->name,
            'media_aprovacao' => $cursoRequest->media_aprovacao ?? 0,
            'numero_alunos'   => $cursoRequest->numero_alunos ?? 0,
        ]);

        return response(new CursoResource($curso), 201);
    }

    public function show(Curso $curso)
    {
        return new CursoResource($curso);
    }

    public function update(CursoRequest $cursoRequest, Curso $curso)
    {
        $curso->update([
            'name'            => $cursoRequest->name,
            'media_aprovacao' => $cursoRequest->media_aprovacao,
            'numero_alunos'   => $cursoRequest->numero_alunos,
        ]);

        return response(new CursoResource($curso), 200);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return response(null, 204);
    }
}
