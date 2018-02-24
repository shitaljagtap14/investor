<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
        'users_id','payment_id','item_number','item_name','amount','date'
    ];


    public function userTrasaction()
    {
        return $this->belongsTo(User::class,'users_id');

    }
}
