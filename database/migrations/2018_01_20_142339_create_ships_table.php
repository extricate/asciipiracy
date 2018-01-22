<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cannons');
            $table->integer('gunports');

            // owned by
            $table->integer('user_id')->default(1);

            $table->string('class');
            $table->string('type');

            $table->enum('cannon_caliber', ['4 pounder', '6 pounder', '9 pounder', '12 pounder', '18 pounder', '24 pounder', '32 pounder', '42 pounder']);

            $table->integer('total_hold');

            $table->integer('constructed_at');
            $table->longText('story');

            $table->integer('min_sailors');
            $table->integer('current_sailors');
            $table->integer('max_sailors');

            $table->integer('max_speed');
            $table->integer('masts');
            $table->integer('propulsion');
            $table->integer('decks');
            $table->integer('length');
            $table->integer('draught');
            $table->integer('beam');

            $table->integer('maneuverability');

            $table->date('updated_at');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ships');
    }
}
