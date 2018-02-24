<?php
use App\Helpers\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'subscriptions', 'subscription_id');
            Helper::setForeignKey($table, 'sweepstakes', 'sweepstakes_id');
            Helper::setForeignKey($table, 'purchase_coins','purchase_id');
            Helper::setForeignKey($table, 'users', 'user_id');
            $table->integer('total');
            $table->integer('interest');
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
        Schema::dropIfExists('balances');
    }
}
