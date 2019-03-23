<?php

namespace App\Domain\Tests\Controllers;

use App\Domain\User\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAutenticacaoComSucesso()
    {
        $user = factory(User::class)->create([
            'email'    => 'test@test.com',
            'password' => 'password',
        ]);

        dd($user);
        $email    = 'test@test.com';
        $password = '1234';

        factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $payload['email']    = $email;
        $payload['password'] = $password;

        $response = $this->json('POST', '/api/auth', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

}
