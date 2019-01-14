<?php

namespace App\Domain\Auth;

use Illuminate\Http\Request;
use JWTAuth;

class AuthController
{
    protected $service;

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function authenticate(Request $request)
    {
        try {

            $token = $this->service->gerarToken($request->email, $request->password);

            return response(compact('token'));

        } catch (Exception $e) {

            return response('Verifique o seu E-Mail ou/e Senha');
        }
    }

    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return response(compact('token'));
    }
}
