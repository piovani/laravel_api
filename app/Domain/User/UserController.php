<?php

namespace App\Domain\User;

use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }
}
