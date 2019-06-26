<?php

namespace App\Domain\Localization\State;

use App\Http\Controllers\Controller;
use App\Domain\Localization\City\CityResource;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        return StateResource::collection(
            State::where(function ($query) use ($request) {
                $query->where('name',     'like', "%{$request->seach}%")
                    ->orWhere('initials', 'like', "%{$request->seach}%");
            })->paginate()
        );
    }

    public function show(State $state)
    {
        return new StateResource($state);
    }

    public function cities(Request $request)
    {
        return CityResource::collection(
            State::findOrFail($request->id)
                ->cities()
                ->paginate()
        );
    }
}
