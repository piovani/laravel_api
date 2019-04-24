<?php

namespace App\Domain\Localization\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Localization\City\CityResource;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return CityResource::collection(
            City::where('name', 'like', "%{$request->search}%")
                ->paginate()
        );
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }
}
