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
            $table->unsignedInteger('gold')->default(0);
            $table->unsignedInteger('goods')->default(100);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('active_ship')->nullable();
            $table->unsignedInteger('combat_wins')->default(0)->nullable();
            $table->unsignedInteger('combat_losses')->default(0)->nullable();
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
