<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('state')->group(function () {
    Route::get('/', 'Localization\State\StateController@index');
    Route::get('/{id}', 'Localization\State\StateController@show');
    Route::get('/{id}/cities', 'Localization\State\StateController@cities');
});

Route::resource('city', 'Localization\City\CityController')->except('edit', 'create');
