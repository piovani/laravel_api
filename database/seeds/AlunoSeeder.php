<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Domain\School\Aluno\Aluno;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alunos')->truncate();

        factory(Aluno::class, 200)->create();
    }
}
