<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSweeptakeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sweeptake_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('win_product');
            $table->integer('sweeptakes_entry');
            $table->integer('no_of_winner');
            $table->integer('limit_of_participate');
            $table->date('till_at');
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
        Schema::dropIfExists('sweeptake_offers');
    }
}
