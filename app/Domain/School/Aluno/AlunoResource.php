<?php

namespace App\Domain\School\Aluno;

use App\Domain\Localization\City\CityResource;
use App\Domain\School\Curso\CursoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'cpf'    => $this->cpf,
            'curso'  => new CursoResource($this->curso),
            'city'   => new CityResource($this->city),
            'faltas' => $this->faltas,
        ];
    }
}
