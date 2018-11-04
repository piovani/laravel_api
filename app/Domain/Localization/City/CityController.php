<?php

namespace App\Domain\Localization\City;

use App\Domain\Localization\City\City;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Generator as Faker;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $states = City::paginate($request->get('perPage') ?: 15);

        return response($states);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'state' => 'required',
        ]);

        $faker = new Faker();
        $city = new City();
        $city->id = $faker->uuid;

        dd($city);
        $city->name = $request->get('name');
        $city->state = $request->get('state');
        $city->save();

        return response($city);
    }

    public function show(City $city)
    {
        return response($city);
    }

    public function update(Request $request, City $city)
    {
        $city->name = $request->get('name') ?? $city->name;
        $city->state = $request->get('state') ?? $city->state;

        if (!$city->save()) {
            return response(['menssage' => 'Erro ao atualizar o registro'], 422);
        }

        return response($city);
    }

    public function destroy(City $city)
    {
        if (!$city->delete()) {
            return response(['menssage' => 'Erro ao excluir o registro'], 422);
        }

        return response($city);
    }
}
