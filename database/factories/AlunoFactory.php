<?php

use App\Domain\School\Aluno\Aluno;
use Faker\Generator as Faker;
use App\Domain\School\Curso\Curso;
use App\Domain\Localization\State\State;
use App\Domain\Localization\City\City;

$factory->define(Aluno::class, function (Faker $faker) {

    $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'cpf' => $faker->cpf,
        'curso_id' => factory(Curso::class)->create()->id,
        'state_id' => $state_id ?? State::inRandomOrder()->first()->id,
        'city_id' => $city_id ?? City::inRandomOrder()->first()->id,
        'faltas' => 0,
    ];
});
