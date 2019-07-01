<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\State\State;
use App\Http\Controllers\Controller;
use App\Domain\Localization\State\StateResource;
use App\Domain\Localization\City\CityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = Cache::remember('states', 1, function () use ($request) {
            return State::where('name',     'like', "%{$request->seach}%")
                ->orWhere('initials', 'like', "%{$request->seach}%");
            }
        );

        return StateResource::collection($states);
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
