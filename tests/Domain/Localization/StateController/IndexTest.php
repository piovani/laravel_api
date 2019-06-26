<?php

namespace Tests\Localization\StateController;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class IndexTest extends TestCase
{
    private $url = 'api/state';

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed --class=StateSeeder');
    }

    /** @test  */
    public function state_structure()
    {
        $this->get($this->url)
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

    /** @test */
    public function seach_in_request_state_with_one_result()
    {
        $response     = $this->get($this->url . '?seach=Acre')->assertSuccessful();
        $responseJson = $response->decodeResponseJson();

        self::assertCount(1, $responseJson['data']);
    }

    /** @test */
    public function paginate_on_page_2()
    {
        $response     = $this->get($this->url . '?page=2')->assertSuccessful();
        $responseJson = $response->decodeResponseJson();

        self::assertEquals(2, $responseJson['meta']['current_page']);
    }
}