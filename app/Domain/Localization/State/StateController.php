<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\City\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::paginate($request->get('perPage') ?: 15);

        return response($states);
    }

    public function show($id)
    {
        $state = State::findOrFail($id);

        return \response($state, 200);
    }

    public function cities(Request $request, $id)
    {
        $state = State::findOrFail($id);
        $cities = City::where('state', $state->initials)->paginate($request->get('perPage') ?: 15);

        return response($cities);
    }
}
