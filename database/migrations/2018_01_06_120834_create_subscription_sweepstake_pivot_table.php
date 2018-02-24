<?php

use App\Helpers\Helper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionSweepstakePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_sweepstake', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'subscriptions', 'subscription_id');
            Helper::setForeignKey($table, 'sweepstakes', 'sweepstake_id');
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
        Schema::drop('subscription_sweepstake');
    }
}
