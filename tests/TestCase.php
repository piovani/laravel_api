<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\FactoriesHelpers;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, FactoriesHelpers;
}
