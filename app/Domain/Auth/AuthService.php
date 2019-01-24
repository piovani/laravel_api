<?php

namespace App\Domain\Auth;

use JWTAuth;
use App\Domain\User\User;
use Tymon\JWTAuth\Exceptions\JWTException as Exception;

class AuthService
{
    public function gerarToken($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new Exception('Usuário não encontrado');
        }

        if ($user->password !== $password) {
            throw new Exception('Senha não confere');
        }

        return JWTAuth::fromUser($user);
    }
}