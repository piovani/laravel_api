<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/*
 * @group city
 * @group Localization
 */
class CityControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $routeBase = 'api/city';

    public function deveRetornarAPrimeiraPagina()
    {
        $response = $this->json('GET', $this->routeBase);

        $response
            ->assertStatus(200)
            ->assertJson([
                "current_page",
                "data",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"
            ]);
    }
}
