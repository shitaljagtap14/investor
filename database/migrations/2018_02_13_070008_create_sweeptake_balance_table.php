<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;
class CreateSweeptakeBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sweeptake_balance', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'users', 'users_id');
            Helper::setForeignKey($table, 'sweepstakes', 'sweepstakes_id');
            $table->integer('sweeptake_point')->nullable();

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
            Schema::dropIfExists('sweeptake_balance');
        }

}
