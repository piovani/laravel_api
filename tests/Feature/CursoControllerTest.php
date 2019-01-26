<?php

namespace App\Domain\Tests;

use App\Domain\School\Curso\Curso;
use Tests\TestCase;

class CursoControllerTest extends TestCase
{
    public function deveRetornarAprimeiraPaginaDaListagemDeArquivo()
    {
        factory(Curso::class, 16)->create();
        $curso = Curso::first();

        $response = $this->json('GET', 'api/curso');

        $response
            ->assertStatus(200)
            ->assertJson([
                "current_page" => 1,
                "data" => [
                    "id" => $curso->id,
                    "name" => $curso->name,
                    "media_aprovacao" => $curso->media_aprovacao,
                    "numero_alunos" => $curso->numero_alunos,
                    "deleted" => $curso->deleted,
                    "created_at" => $curso->created_at,
                    "updated_at" => $curso->updated_at,
                ]
            ]);
    }

    //NECESSARIO FINALIZAR O TESTE
    public function deveTestarAlteracaoDoRegistroCurso()
    {
        $curso = factory(Curso::class)->create();

        dd($curso);

        $response = $this->json('GET', 'api/curso');

        $response
            ->assertStatus(200)
            ->assertJson([
                "current_page" => 1,
                "data" => [
                    "id" => $curso->id,
                    "name" => $curso->name,
                    "media_aprovacao" => $curso->media_aprovacao,
                    "numero_alunos" => $curso->numero_alunos,
                    "deleted" => $curso->deleted,
                    "created_at" => $curso->created_at,
                    "updated_at" => $curso->updated_at,
                ]
            ]);
    }
}