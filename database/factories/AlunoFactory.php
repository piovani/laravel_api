<?php

use App\Domain\School\Aluno\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'cpf' => $geradorDocuments->cpf(),
        'id_curso' => $curso->id,
        'deleted' => false,
    ];
});
