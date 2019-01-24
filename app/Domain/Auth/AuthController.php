<?php

namespace App\Domain\Auth;

use Illuminate\Http\Request;
use JWTAuth;
use Exception;

class AuthController
{
    protected $service;

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function authenticate(Request $request)
    {
        $token = $this->service->gerarToken($request->email, $request->password);

        dd($token);

        try {


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
