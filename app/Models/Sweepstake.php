<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sweepstake
 * @package App\Models
 * @property mixed subscription_id
 * @property mixed entry_point
 * @property Subscription subscriptions
 * @property Subscription subscription
 * @property PurchaseCoin purchase_coins
 */
class Sweepstake extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'subscription_id', 'entry_point'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions() {
        return $this->belongsToMany(Subscription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //when One To Many then use it

    public function purchase_coins() {
        return $this->hasMany(PurchaseCoin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function winner() {
        return $this->hasMany(Winner::class);
    }

    public function sweeptakePurchaseUser()
    {
        return $this->belongsToMany(Sweepstake::class, 'user_package_details', 'sweepstakes_id', 'users_id');

    }


}
