<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSweeptakeStatusToUserSweeptakeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_sweeptake_offers', function (Blueprint $table) {
            $table->boolean('package_Status')->after('users_id')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_sweeptake_offers', function (Blueprint $table) {
            $table->drop('package_Status');
        });
    }
}
