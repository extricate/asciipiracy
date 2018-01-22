<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('level')->default(1);
            $table->integer('experience')->default(0);

            // attributes
            $table->integer('strength')->default(15);
            $table->integer('dexterity')->default(15);
            $table->integer('intelligence')->default(15);
            $table->integer('stamina')->default(15);
            $table->integer('charisma')->default(15);

            $table->integer('doubloons')->default(0);
            $table->integer('renown')->default(0);
            $table->integer('nationality')->default(0);
            $table->integer('personality')->default(0);
            $table->integer('health')->default(100);

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
        Schema::dropIfExists('people');
    }
}
