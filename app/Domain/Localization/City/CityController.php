<?php

namespace App\Domain\Localization\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Localization\City\CityRequest;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return response(City::paginate($request->get('perPage') ?: 15));
    }

    public function show(City $city)
    {
        return response($city);
    }
}
