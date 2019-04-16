<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\User\User;

class AlunoControllerTest extends TestCase
{
    private $urlBase = "aluno";

    public function __construct()
    {
        $user = factory(User::class)->create();

        dd('qwui');
    }

    public function test_list_alunos()
    {
        $response = $this->json('GET', $this->urlBase);

        $response->assertStatus(200);
    }
}
