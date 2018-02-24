<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @package App\Models
 * @property mixed package
 * @property mixed amount
 * @property mixed reward_point
 * @property mixed bonus_point
 * @property mixed extra_point
 * @property mixed interest
 * @property mixed status
 * @property mixed status_level
 * @property Sweepstake sweepstakes
 */
class Subscription extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'package','amount','reward_point','bonus_point','extra_point','interest','status',
        'status_level'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sweepstakes() {
        return $this->hasMany(Sweepstake::class);
    }
}
