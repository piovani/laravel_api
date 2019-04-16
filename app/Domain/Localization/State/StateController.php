<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\City\City;
use App\Domain\Localization\State\State;
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

        return response($state, 200);
    }

    public function cities(Request $request)
    {
        return City::where('state_id', $request->id)
            ->paginate($request->get('perPage') ?: 15);
    }
}
