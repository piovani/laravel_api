<?php

namespace App\Domain\School\Aluno;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|max:255',
            'cpf'      => 'required|min:11|max:11',
            'curso_id' => 'required|exists:cursos,id',
            'city_id'  => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
        ];
    }
}
