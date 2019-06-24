<?php

namespace Tests\Localization;

use PHPUnit\Framework\TestCase;
use App\Domain\Localization\State\State;

class StateTest extends TestCase
{
    public function testAttributes()
    {
        $state = factory()->create();
        dd($state);

//        $this->assertClassHasAttribute('id', State::class);
    }
}