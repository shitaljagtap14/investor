<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPackageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_package_details', function (Blueprint $table) {
            $table->increments('id');
            Helper::setForeignKey($table, 'users', 'users_id');
            Helper::setForeignKey($table, 'sweepstakes', 'sweepstakes_id');

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
        Schema::dropIfExists('user_package_details');
    }
}
