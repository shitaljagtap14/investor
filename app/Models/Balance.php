<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    protected $table = 'sweeptake_balance';
    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id', 'sweepstakes_id','sweeptake_point'
    ];
}
