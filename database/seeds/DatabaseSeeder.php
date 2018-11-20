<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //LOCALIZATION
        $this->call('StateSeeder');
        $this->call('CitySeeder');

        //SCHOOL
        $this->call('CursoSeeder');
        $this->call('AlunoSeeder');
    }
}
