<?php

Route::post('auth', 'Auth\AuthController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user','User\UserController@show');

    Route::prefix('state')->group(function () {
        Route::get('/', 'Localization\State\StateController@index');
        Route::get('/{id}', 'Localization\State\StateController@show');
        Route::get('/{id}/cities', 'Localization\State\StateController@cities');
    });

    Route::resource('city', 'Localization\City\CityController')->except('edit', 'create');

    Route::resource('curso', 'School\Curso\CursoController')->except('edit', 'create');

    Route::resource('aluno', 'School\Aluno\AlunoController')->except('edit', 'create');
    Route::get('aluno/relacao/curso', 'School\Aluno\AlunoController@getRelacaoAlunoCurso');
});


