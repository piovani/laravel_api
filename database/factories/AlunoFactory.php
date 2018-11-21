<?php

use App\Domain\School\Aluno\Aluno;
use Faker\Generator as Faker;
use App\Domain\School\Curso\Curso;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'cpf' => 'teste',
        'curso_id' => factory(Curso::class)->create()->id,
        'deleted' => false,
    ];
});
