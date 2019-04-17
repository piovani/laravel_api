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
        return response(State::paginate());
    }

    public function show(State $state)
    {
        return response($state, 200);
    }

    public function cities(Request $request)
    {
        $request->validate([
            'id' => 'exists:states,id'
        ]);

        return City::where('state_id', $request->id)
            ->paginate($request->get('perPage') ?: 15);
    }
}
