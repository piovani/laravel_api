<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\Localization\State\State::class, function (Faker $faker) {
    return [
        'id'       => $faker->uuid,
        'name'     => $faker->state,
        'initials' => $faker->stateAbbr,
    ];
});
