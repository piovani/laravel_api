<?php

namespace Tests\Domain\Localization\CityController;

use Tests\TestCase;

class CityIndexTest extends TestCase
{
    /** @var string  */
    private $url = 'api/city';

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
            ->assertJsonCount(7, 'meta')
            ->assertJson(['meta' => ['total' => 5560]]);
    }

    /** @test */
    public function should_bring_the_correct_page_of_cities()
    {
        $this->get($this->url. '?page=2')
            ->assertStatus(200)
            ->assertJson(['meta' => [
                'current_page' => 2,
                'total'        => 5560,
            ]]);
    }

    /** @test */
    public function must_bring_city_that_fit_the_query()
    {
        $this->get($this->url . '?search=Alagoas')
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
