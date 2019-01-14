<?php

namespace App\Domain\Auth;

use Tymon\JWTAuth\JWTAuth;

class AuthService
{
    public function gerarToken($email, $password)
    {

        return JWTAuth::fromUser();
    }
}