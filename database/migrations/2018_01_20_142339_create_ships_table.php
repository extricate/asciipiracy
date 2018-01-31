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
            // owned by
            $table->unsignedInteger('user_id')->default(1)->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_beginner_ship')->default(false);
            $table->unsignedInteger('upgrade_points')->default(0);

            $table->string('name');
            $table->string('slug')->unique()->nullable();

            $table->integer('current_health')->default(100);
            $table->unsignedInteger('maximum_health')->default(100);

            $table->unsignedInteger('cannons');
            $table->unsignedInteger('gunports');

            $table->string('class');
            $table->string('type');

            $table->enum('cannon_caliber', ['4 pounder', '6 pounder', '9 pounder', '12 pounder', '18 pounder', '24 pounder', '32 pounder', '42 pounder']);

            $table->unsignedInteger('total_hold');

            // trade goods
            $table->unsignedInteger('tobacco')->default(0);
            $table->unsignedInteger('furs')->default(0);
            $table->unsignedInteger('gemstones')->default(0);
            $table->unsignedInteger('textiles')->default(0);
            $table->unsignedInteger('alcohol')->default(0);
            $table->unsignedInteger('sugar')->default(0);
            $table->unsignedInteger('spices')->default(0);
            $table->unsignedInteger('ivory')->default(0);
            $table->unsignedInteger('coffee')->default(0);
            $table->unsignedInteger('mahogany')->default(0);

            $table->unsignedInteger('constructed_at');
            $table->longText('story')->nullable();

            $table->unsignedInteger('min_sailors');
            $table->unsignedInteger('max_sailors');

            $table->unsignedInteger('max_speed');
            $table->unsignedInteger('masts');
            $table->unsignedInteger('propulsion');
            $table->unsignedInteger('decks');
            $table->unsignedInteger('length');
            $table->unsignedInteger('draught');
            $table->unsignedInteger('beam');

            $table->unsignedInteger('maneuverability');

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
