<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique()->nullable();

            $table->unsignedInteger('location_id')->nullable();

            $table->unsignedInteger('max_ships')->default(5);

            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('experience')->default(0)->nullable();
            $table->unsignedInteger('experience_next_level')->default(100)->nullable();
            $table->unsignedInteger('gold')->default(0);
            $table->unsignedInteger('goods')->default(100);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('active_ship')->nullable();
            $table->unsignedInteger('combat_wins')->default(0)->nullable();
            $table->unsignedInteger('combat_losses')->default(0)->nullable();
            $table->integer('exploration_count')->default(0);
            $table->boolean('is_in_combat')->default(false);
            $table->unsignedInteger('is_in_combat_with')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
