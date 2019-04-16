<?php

namespace App\Domain\School\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlunoController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new AlunoService();
    }

    public function index(Request $request)
    {
        return response($this->service->getList($request));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        return response($this->service->store($request), 201);
    }

    public function show(Aluno $aluno)
    {
        return response($aluno, 200);
    }

    public function update(Request $request, Aluno $aluno)
    {
        $this->validation($request);

        return response($this->service->update($aluno, $request), 200);
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return response('', 204);
    }

    private function validation(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'cpf'      => 'required|min:11|max:11',
            'curso_id' => 'required|exists:cursos,id',
            'city_id'  => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
        ]);
    }
}
