<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package')->nullable();
            $table->string('amount')->nullable();
            $table->string('reward_point')->nullable();
            $table->string('bonus_point')->nullable();
            $table->string('extra_point')->nullable();
            $table->string('interest')->nullable();
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->string('status_level')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
