<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/* Class Sweepstake
 * @package App\Models
* @property mixed win_product
 * @property mixed sweeptakes_entry
 * @property mixed no_of_winner
 * @property mixed limit_of_participate
 * @property mixed till_at
 *
* @property Subscription subscriptions
* @property Subscription subscription
* @property PurchaseCoin purchase_coins
*/
class SweeptakeOffer extends Model
{

    protected $table = 'sweeptake_offers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'win_product','sweeptakes_entry','no_of_winner','limit_of_participate','till_at'
    ];



    public function userSweeptake()
    {
        return $this->belongsToMany(User::class,'user_sweeptake_offers','sweeptake_offers_id', 'users_id');
    }

    public function winners()
    {
        return $this->hasMany(Winner::class,'sweepstake_id');
    }

}