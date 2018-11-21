<?php

use Faker\Generator as Faker;
use App\Domain\Localization\State\State;

$factory->define(App\Domain\Localization\City\City::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' =>  $faker->name,
        'state_id' => $state_id ?? State::inRandomOrder()->first()->id,
    ];
});
