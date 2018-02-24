<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $fillable = ['item_number','transaction_id','currency_code','payment_status'];
    public function payments(){
        return $this->belongsTo(Payments::class);
    }
}
