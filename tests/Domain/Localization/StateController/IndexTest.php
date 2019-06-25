<?php

namespace Tests\Localization\StateController;

use Tests\TestCase;

class IndexTest extends TestCase
{
    private $url = 'api/state';

    /** @test  */
    public function state_structure()
    {
        $reponse = $this->get($this->url);

        $reponse
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'initials',
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ]
            ]);
    }
}