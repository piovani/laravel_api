<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\Localization\State\State::class, function (Faker $faker) {

    $name = $faker->name;

    return [
        'id' => $faker->uuid,
        'name' =>  $name,
        'initials' => substr($name, 0, 2),
    ];
});
