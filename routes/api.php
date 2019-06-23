<?php

Route::post('auth', 'Auth\AuthController@authenticate');

//Localization
Route::resource('state', 'Localization\State\StateController')->only('index', 'show');
Route::get('state/{id}/cities', 'Localization\State\StateController@cities');
Route::resource('city', 'Localization\City\CityController')->except('edit', 'store', 'create', 'update', 'destroy');


Route::group(['middleware' => ['jwt.verify']], function() {
    //Auth
    Route::post('refresh', 'Auth\AuthController@refresh');

    //User
    Route::get('user','User\UserController@show');

    //School
    Route::resource('curso', 'School\Curso\CursoController')->except('edit', 'create');

    Route::resource('aluno', 'School\Aluno\AlunoController')->except('edit', 'create');
});


