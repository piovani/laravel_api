<?php

namespace Tests\Domain\Localization\CityController;

use App\Domain\Localization\State\State;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CityShowTest extends TestCase
{
    use DatabaseTransactions;

    /** @var string  */
    private $url = 'api/city';

    /** @test */
    public function must_bring_requested_city()
    {
        $state = State::inRandomOrder()->first();
        dd($state);

        $response = get($this->url . '/' . $state->id);

        dd('AQUI');

//        $this->get($this->url . '/' . $state->id)
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'data' => [
//                    '*' => [
//                        'id',
//                        'name',
//                        'state' => [
//                            'id',
//                            'name',
//                            'initials',
//                        ]
//                    ]
//                ]
//            ]);
    }
}
