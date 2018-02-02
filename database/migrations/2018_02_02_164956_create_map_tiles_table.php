<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_tiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->uuid('map')->onDelete('cascade');
            $table->foreign('map')->references('map_id')->on('maps')->onDelete('cascade');

            $table->unsignedInteger('settlement')->onDelete('cascade')->nullable();
            $table->foreign('settlement')->references('id')->on('settlements')->onDelete('cascade');

            $table->unsignedInteger('ship')->onDelete('cascade')->nullable();
            $table->foreign('ship')->references('id')->on('ships')->onDelete('cascade');

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
        Schema::dropIfExists('map_tiles');
    }
}
