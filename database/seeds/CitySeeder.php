<?php

use Illuminate\Database\Seeder;
use App\State;
use App\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->truncate();
        $staties = State::all()->pluck('id')->toArray();

        $faker = Faker::create();

        foreach (range(1, 50) as $i) {
            City::create([
                'id' => $faker->uuid,
                'name' => $faker->name,
                'state' => $faker->randomElement($staties)
            ]);
        }
    }
}
