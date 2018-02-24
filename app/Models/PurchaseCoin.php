<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseCoin
 * @package App\Models
 * @property mixed sweepstake_id
 * @property mixed reword_point
 * @property mixed additional_point
 * @property mixed amount
 * @property Sweepstake sweepstake
 */
class PurchaseCoin extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
       'reword_point', 'additional_point', 'amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   /* public function sweepstake() {
        return $this->belongsTo(Sweepstake::class);
    }*/
   //its relation one to one relation
    public function purchase(){
        return $this->belongsTo(PurchaseCoin::class);
    }
}
