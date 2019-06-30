<?php

namespace Tests\Domain\Localization\StateController;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StateCitiesTest extends TestCase
{
    /** @var string  */
    private $url = 'api/state';

    private function getUrl($idState): string
    {
        return $this->url . '/' . $idState . '/cities';
    }
}