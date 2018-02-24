<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sweepstake
 * @package App\Models
 * @property mixed sweepstake_id
 * @property mixed user_id
 *  @property mixed winner_no
 * @property Sweepstake sweepstakes
 * @property User users
 * @property PurchaseCoin purchase_coins
 */
class winner extends Model
{
    protected $table = 'winners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sweepstake_id', 'user_id','winner_no'
    ];

    public function sweepstake()
    {
        return $this->belongsTo(Sweepstake::class);
    }
    public function sweepstakes() {
        return $this->belongsToMany(Sweepstake::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}