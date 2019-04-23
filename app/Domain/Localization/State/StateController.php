<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\City\City;
use App\Domain\Localization\State\State;
use App\Http\Controllers\Controller;
use App\Domain\Localization\State\StateResource;

use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        return StateResource::collection(
            State::where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->seach}%")
                    ->orWhere('initials', 'like', "%{$request->seach}%");
            })
                ->paginate()
        );
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
