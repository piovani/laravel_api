<?php

use App\Domain\Localization\State\State;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name', '80');
            $table->string('initials', '2');
            $table->timestamps();
            $table->softDeletes();
        });

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
            $query = sprintf("insert into states ('id', 'name', 'initials') values ('%s', '%s', '%s')", $faker->uuid, $array[0], $array[1]);
            DB::insert($query);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
