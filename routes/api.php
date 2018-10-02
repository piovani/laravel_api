<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('state', 'StateController')->only('index', 'show');
//
//Route::prefix('state')->group(function () {
//    Route::get('/', 'StateController@index');
//    Route::get('/{id}', 'StateController@show');
//});


Route::prefix('city')->group(function () {
    Route::get('/', 'PeopleController@index');
    Route::get('/{id}', 'PeopleController@show');
    Route::post('/', 'PeopleController@store');
    Route::put('/', 'PeopleController@update');
    Route::delete('/{id}', 'PeopleController@destroy');
});

Route::prefix('people')->group(function () {
    Route::get('/', 'PeopleController@index');
    Route::get('/{id}', 'PeopleController@show');
    Route::post('/', 'PeopleController@store');
    Route::put('/', 'PeopleController@update');
    Route::delete('/{id}', 'PeopleController@destroy');
});
