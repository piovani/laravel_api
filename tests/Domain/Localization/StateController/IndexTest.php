<?php

namespace Tests\Localization\StateController;

use Tests\TestCase;

class IndexTest extends TestCase
{
    private $url = 'api/state';

    public function test_estrutura_do_response_state()
    {
        $reponse = $this->get($this->url);

        $reponse->assertStatus(200);
    }
}