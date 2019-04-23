<?php

namespace App\Domain\School\Curso;

use Illuminate\Http\Resources\Json\JsonResource;

class CursoResource extends JsonResource
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
            'id'              => $this->id,
            'name'            => $this->name,
            'media_aprovacao' => $this->media_aprovacao,
            'numero_alunos'   => $this->numero_alunos,
        ];
    }
}
