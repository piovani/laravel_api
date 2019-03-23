<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Domain\Localization\State\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
        $faker = Faker::create();

        $states = collect([
            ["Acre", "ac"],
            ["Alagoas", "al"],
            ["Amazonas", "am"],
            ["Amapá", "ap"],
            ["Bahia", "ba"],
            ["Ceará", "ce"],
            ["Destrito Federal", "df"],
            ["Espírito Santo", "es"],
            ["Goiás", "go"],
            ["Maranhão", "ma"],
            ["Mato Grosso", "mt"],
            ["Mato Grosso do Sul", "ms"],
            ["Minas Gerais", "mg"],
            ["Pará", "pa"],
            ["Paraíba", "pb"],
            ["Paraná", "pr"],
            ["Pernambuco", "pe"],
            ["Piauí", "pi"],
            ["Rio de Janeiro", "rj"],
            ["Rio Grande do Norte", "rn"],
            ["Rondônia", "ro"],
            ["Rio Grande do Sul", "rs"],
            ["Roraima", "rr"],
            ["Santa Catarina", "sc"],
            ["Segipe", "se"],
            ["São Paulo", "sp"],
            ["Tocantins", "to"]
        ]);

        $states->each(function ($array) use ($faker) {
            State::create([
                'id'       => $faker->uuid,
                'name'     => $array[0],
                'initials' => $array[1],
            ]);
        });
    }
}
