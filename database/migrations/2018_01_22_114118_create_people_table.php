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
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('experience')->default(0);
            $table->string('rank')->default('Sailor');

            // serves on
            $table->unsignedInteger('ships_id')->onDelete('cascade');
            $table->foreign('ships_id')->references('id')->on('ships')->onDelete('cascade');

            // attributes
            $table->unsignedInteger('strength')->default(15);
            $table->unsignedInteger('dexterity')->default(15);
            $table->unsignedInteger('intelligence')->default(15);
            $table->unsignedInteger('stamina')->default(15);
            $table->unsignedInteger('charisma')->default(15);

            $table->unsignedInteger('doubloons')->default(0)->nullable();
            $table->unsignedInteger('renown')->default(0)->nullable();
            $table->unsignedInteger('nationality')->default(0)->nullable();
            $table->unsignedInteger('personality')->default(0)->nullable();
            $table->unsignedInteger('health')->default(100)->nullable();

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
