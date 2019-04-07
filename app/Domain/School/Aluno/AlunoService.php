<?php

namespace App\Domain\School\Aluno;

use App\Domain\School\Curso\Curso;
use Illuminate\Http\Request;

class AlunoService
{
    public function getList(Request $request)
    {
        return AlunoFilter::seach($request->search)->paginate($request->perPage ?: 15);
    }

    public function store(Request $request)
    {
        self:$this->validate($request);

        $aluno = factory(Curso::class)->create();
        $aluno->name = $request->name;
        $aluno->cpf = $request->cpf;
        $aluno->id_curso = $request->id_curso;
        $aluno->save();
    }

    public function update(Aluno $aluno, Request $request)
    {
        $aluno->update([
            'name'     => $request->name,
            'id_curso' => $request->id_curso,
        ]);
    }

    private function validate(Request $request)
    {
        return $request->validate([
            'id'  => 'required',
            'cpf' => 'required|min:11|max:11',
        ]);
    }
}