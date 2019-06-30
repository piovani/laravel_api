<?php

namespace Tests\Domain\Localization\CityController;

use App\Domain\Localization\City\City;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @var string  */
    private $url = 'api/city';

    public function setUp(): void
    {
        parent::setUp();

        factory(City::class, 2)->create();
    }

    /** @test */
    public function should_bring_correct_structure_of_cities()
    {
        $this->get($this->url)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'state' => [
                            'id',
                            'name',
                            'initials',
                        ]
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
                    'total'
                ]
            ]);
    }

    /** @test */
    public function should_bring_the_right_amount_of_cities()
    {
        $this->get($this->url)
            ->assertStatus(200)
            ->assertJsonCount(15, 'data')
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta');
    }
}
