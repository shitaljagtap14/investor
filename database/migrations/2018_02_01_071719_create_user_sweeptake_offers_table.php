<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\Helper;
class CreateUserSweeptakeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sweeptake_offers', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'sweeptake_offers', 'sweeptake_offers_id');
            Helper::setForeignKey($table, 'users', 'users_id');
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
        Schema::dropIfExists('user_sweeptake_offers');
    }
}
