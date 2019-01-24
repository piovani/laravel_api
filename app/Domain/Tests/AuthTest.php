<?php

namespace App\Domain\Tests;

use App\Domain\User\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testAutenticacaoComSucesso()
    {
        $user = factory(User::class)
            ->create([
                'email'    => 'test@test.com',
                'password' => '1234',
            ]);

        dd($user);
    }

    public function testAutenticacaoComEmailErrado()
    {

    }

    public function testAutenticacaoComSenhaErrada()
    {

    }

}
