<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('cpt', 11);
            $table->string('curso_id');

            $table->uuid('city_id');
            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities');

            $table->uuid('state_id');
            $table
                ->foreign('state_id')
                ->references('id')
                ->on('states');

            $table->integer('faltas')->default(0);
            $table->dateTime('deleted')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
