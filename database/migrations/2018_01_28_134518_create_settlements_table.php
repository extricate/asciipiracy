<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['Outpost', 'Monastery', 'Haven', 'Village', 'Town', 'City', 'Metropolis', 'Capital']);
            $table->unsignedInteger('nation')->nullable();
            $table->unsignedInteger('inhabitants')->default(100);
            $table->date('founded')->nullable();
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
        Schema::dropIfExists('settlements');
    }
}
