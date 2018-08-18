<?php

use Illuminate\Database\Seeder;
use App\People;
use Faker\Factory as Faker;

class PeopleSeeder extends Seeder
{
    public function run()
    {
        DB::table('people')->truncate();

        $faker = Faker::create();

        foreach (range(1, 50) as $i) {
            People::create([
                'id' => $faker->uuid,
                'first_name' => $faker->name,
                'last_name' => $faker->lastName,
                'bith_date' => $faker->date('Y-m-d')
            ]);
        }
    }
}