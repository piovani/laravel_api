<?php

namespace Tests\Domain\Localization\StateController;

use App\Domain\Localization\State\State;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ShowTest extends TestCase
{
    private $url = 'api/state';

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed --class=StateSeeder');
    }

    /** @test */
    public function query_one_state_by_id()
    {
        $state    = State::inRandomOrder()->first();
        $response = $this->get($this->url . '/' . $state->id)
            ->assertSuccessful()
            ->decodeResponseJson();

        $data     = $response['data'];

        self::assertEquals($state->id, $data['id']);
        self::assertEquals($state->name, $data['name']);
        self::assertEquals($state->initials, $data['initials']);
    }
}