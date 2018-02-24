<?php
/**
 * Created by PhpStorm.
 * User: surgeon
 * Date: 1/6/18
 * Time: 3:07 PM
 */

namespace App\Helpers;


use Illuminate\Database\Schema\Blueprint;

class Helper
{
    /**
     * @param Blueprint $table
     * @param $referred_table
     * @param $field
     * @param string $target_id
     */
    public static function setForeignKey(Blueprint $table, $referred_table , $field , $target_id='id') {
        $table->integer($field, false, true)->nullable();
        $table->foreign($field)
            ->references($target_id)->on($referred_table)
            ->onDelete('cascade');
    }
}