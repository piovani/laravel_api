<?php

use Illuminate\Database\Seeder;
use CursoSeeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++) {
            $curso = new CursoSeeder();
            $curso->save();
        }
    }
}
