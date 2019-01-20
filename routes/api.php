<?php

Route::post('auth', 'Auth\AuthController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('refresh', 'Auth\AuthController@refresh');

    Route::get('user','User\UserController@show');

    Route::resource('state', 'Localization\State\StateController')->only('index', 'show');

    Route::prefix('state')->group(function () {
        Route::get('/{id}/cities', 'Localization\State\StateController@cities');
    });

    Route::resource('city', 'Localization\City\CityController')->except('edit', 'create');

    Route::resource('curso', 'School\Curso\CursoController')->except('edit', 'create');

    Route::resource('aluno', 'School\Aluno\AlunoController')->except('edit', 'create');
    Route::get('aluno/relacao/curso', 'School\Aluno\AlunoController@getRelacaoAlunoCurso');
});


