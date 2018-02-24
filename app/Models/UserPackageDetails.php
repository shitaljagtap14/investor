<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPackageDetails extends Model
{
    protected $table = 'sweeptake_balance';
    protected $fillable = [
        'users_id','sweepstakes_id','sweeptake_point'
    ];
}
