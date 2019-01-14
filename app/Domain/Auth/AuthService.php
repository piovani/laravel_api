<?php

namespace App\Domain\Auth;

use mysql_xdevapi\Exception;
use JWTAuth;
use App\Domain\User\User;

class AuthService
{
    public function gerarToken($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new Exeption('Usuário não encontrado');
        }

        if ($user->password !== $password) {
            throw new Exception('Senha não confere');
        }

        return JWTAuth::fromUser($user);
    }
}