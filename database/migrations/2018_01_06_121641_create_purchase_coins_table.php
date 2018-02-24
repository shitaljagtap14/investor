<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_coins', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'sweepstakes', 'sweepstake_id');
            $table->string('reword_point');
            $table->string('additional_point');
            $table->string('amount');
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
        Schema::dropIfExists('purchase_coins');
    }
}
