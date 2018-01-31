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
            $table->enum('type', ['Monastery', 'Haven', 'Outpost', 'Village', 'Town', 'City', 'Metropolis', 'Capital']);
            $table->unsignedInteger('nation')->nullable();
            $table->unsignedInteger('inhabitants')->default(50);
            $table->date('founded')->nullable();

            // names of stores
            $table->string('general_store_name')->default('Barrels and Things')->nullable();
            $table->string('shipwright_name')->default('Fogbank Hulls')->nullable();
            $table->string('tavern_name')->default('Muddy Anchor')->nullable();

            // trade goods and their prices
            $table->unsignedInteger('tobacco_buy')->default(0);
            $table->unsignedInteger('tobacco_stock')->default(0);
            $table->unsignedInteger('tobacco_sell')->default(0);
            $table->unsignedInteger('furs_buy')->default(0);
            $table->unsignedInteger('furs_stock')->default(0);
            $table->unsignedInteger('furs_sell')->default(0);
            $table->unsignedInteger('gemstones_buy')->default(0);
            $table->unsignedInteger('gemstones_stock')->default(0);
            $table->unsignedInteger('gemstones_sell')->default(0);
            $table->unsignedInteger('textiles_buy')->default(0);
            $table->unsignedInteger('textiles_stock')->default(0);
            $table->unsignedInteger('textiles_sell')->default(0);
            $table->unsignedInteger('alcohol_buy')->default(0);
            $table->unsignedInteger('alcohol_stock')->default(0);
            $table->unsignedInteger('alcohol_sell')->default(0);
            $table->unsignedInteger('sugar_buy')->default(0);
            $table->unsignedInteger('sugar_stock')->default(0);
            $table->unsignedInteger('sugar_sell')->default(0);
            $table->unsignedInteger('spices_buy')->default(0);
            $table->unsignedInteger('spices_stock')->default(0);
            $table->unsignedInteger('spices_sell')->default(0);
            $table->unsignedInteger('ivory_buy')->default(0);
            $table->unsignedInteger('ivory_stock')->default(0);
            $table->unsignedInteger('ivory_sell')->default(0);
            $table->unsignedInteger('coffee_buy')->default(0);
            $table->unsignedInteger('coffee_stock')->default(0);
            $table->unsignedInteger('coffee_sell')->default(0);
            $table->unsignedInteger('mahogany_buy')->default(0);
            $table->unsignedInteger('mahogany_stock')->default(0);
            $table->unsignedInteger('mahogany_sell')->default(0);

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
