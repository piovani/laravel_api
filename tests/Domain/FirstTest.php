<?php

use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function test_first()
    {
        $validate = 1 === 1;
        $this->assertTrue($validate);
    }
}
