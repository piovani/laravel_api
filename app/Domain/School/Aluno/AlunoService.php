<?php

namespace App\Domain\School\Aluno;

use App\Domain\School\Curso\Curso;
use Faker\Factory;
use Illuminate\Http\Request;

class AlunoService
{
    public function getList(Request $request)
    {
        return AlunoFilter::seach($request->search)->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        return \factory(Aluno::class)->create([
            'name'     => $request->name,
            'cpf'      => $request->cpf,
            'curso_id' => $request->curso_id,
            'city_id'  => $request->city_id,
            'state_id' => $request->state_id,
        ]);
    }

    public function update(Aluno $aluno, Request $request)
    {
        Aluno::update([
            'id' => '',
        ], [

        ]);

        $aluno->name     = $request->name     ? $request->name     : $aluno->name;
        $aluno->cpf      = $request->cpf      ? $request->cpf      : $aluno->cpf;
        $aluno->curso_id = $request->curso_id ? $request->curso_id : $aluno->curso_id;
        $aluno->city_id  = $request->city_id  ? $request->city_id  : $aluno->city_id;
        $aluno->state_id = $request->state_id ? $request->state_id : $aluno->state_id;
        $aluno->save();

        return $aluno;
    }
}