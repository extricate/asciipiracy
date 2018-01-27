<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('icon_type')->nullable();
            $table->longText('icon')->nullable();
            $table->unsignedInteger('frequency')->default(1);
            $table->longText('body');
            $table->string('type');
            $table->string('affects');
            $table->string('effect_on');
            $table->string('effect_changed');
            $table->boolean('has_secondary_effect')->default(false);
            $table->string('secondary_affects')->nullable();
            $table->string('secondary_effect_on')->nullable();
            $table->string('secondary_effect_changed')->nullable();
            $table->string('effect');
            $table->string('secondary_effect')->nullable();
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
        //
    }
}
