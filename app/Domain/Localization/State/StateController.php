<?php

namespace App\Domain\Localization\State;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Localization\State\StateRequest;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::paginate($request->get('limit', 15));

        return response($states);
    }

    public function show(State $state)
    {
        return new StateRequest($state);
    }
}
