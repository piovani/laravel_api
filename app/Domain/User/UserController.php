<?php

namespace App\Domain\User;

use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function show()
    {
        return $this->currentUser();
    }
}
