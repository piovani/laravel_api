<?php

namespace Tests\Domain\Localization\StateController;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CitiesTest extends TestCase
{
    /** @var string  */
    private $url = 'api/state';

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed --class=StateSeeder');
    }

    private function getUrl($idState): string
    {
        return $this->url . '/' . $idState . '/cities';
    }
}