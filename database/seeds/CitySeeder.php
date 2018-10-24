<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Domain\Localization\City\City;
use App\Domain\Localization\State\State;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->truncate();
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            City::create([
                'id' => $faker->uuid,
                'name' => $faker->name,
                'state' => $id_state ?? State::inRandomOrder()->first()->id,
            ]);
        }
    }
}
