<?php

use Faker\Generator as Faker;
use App\Domain\School\Curso\Curso;

$factory->define(Curso::class, function (Faker $faker){
    return [
        'id'              => $faker->uuid,
        'name'            => $faker->name,
        'media_aprovacao' => 0,
        'numero_alunos'   => 0,
    ];
});