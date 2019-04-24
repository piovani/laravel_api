<?php

namespace App\Domain\School\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        return AlunoResource::collection(
            Aluno::where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('cpf',  'like', "%{$request->search}%");
            })->paginate()
        );
    }

    public function store(AlunoRequest $alunoRequest)
    {
        $aluno = factory(Aluno::class)->create([
            'name'     => $alunoRequest->name,
            'cpf'      => $alunoRequest->cpf,
            'curso_id' => $alunoRequest->curso_id,
            'city_id'  => $alunoRequest->city_id,
            'state_id' => $alunoRequest->state_id,
            'faltas'   => $alunoRequest ?? 0,
        ]);

        return response(new AlunoResource($aluno), 201);
    }

    public function show(Aluno $aluno)
    {
        return response(new AlunoResource($aluno), 200);
    }

    public function update(AlunoRequest $alunoRequest, Aluno $aluno)
    {
        $aluno->update([
            'name'     => $alunoRequest->name,
            'cpf'      => $alunoRequest->cpf,
            'curso_id' => $alunoRequest->curso_id,
            'city_id'  => $alunoRequest->city_id,
            'state_id' => $alunoRequest->state_id,
            'faltas'   => $alunoRequest->faltas ?? 0,
        ]);

        return response(new AlunoResource($aluno), 200);
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return response('', 204);
    }
}
