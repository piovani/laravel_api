<?php

use Faker\Generator as Faker;
use App\Domain\School\Curso\Curso;

$factory->define(Curso::class, function (Faker $faker){
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'media_aprovacao' => $faker->randomFloat(0, 10),
        'numero_alunos' => $faker->numberBetween(0, 999),
    ];
});