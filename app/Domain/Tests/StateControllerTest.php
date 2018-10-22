<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Domain\Localization\State\State;

class StateControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_deve_retornar_a_quantidade_de_registros_no_banco()
    {
        $states = State::all();

        $this->assertAttributeCount(27, $states);
    }

    public function test_deve_retornar_uma_paginacao_de_states()
    {
        $response = $this->json('GET', 'api/state');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => State::COLUMNS,
                ],
            ]);
    }

    public function test_deve_retornar_um_state_especificado()
    {
        $state = State::all()->first();

        dd($state->id);
        $response = $this->json('GET', 'api/state/' . $state->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => State::COLUMNS,
            ]);
    }
}
