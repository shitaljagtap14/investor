<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/* Class Sweepstake
 * @package App\Models
* @property mixed sweeptake_offers_id
* @property mixed users_id
*/
class UserSweeptakeOffer extends Model
{

    protected $table = 'user_sweeptake_offers';
    protected $fillable = [
        'sweeptake_offers_id','users_id','package_Status'
    ];

    public function userSweeptakejoin() {
        return $this->belongsToMany(Subscription::class);
    }

    public function sweeptakeOffers() {
        return $this->belongsTo(SweeptakeOffer::class, 'sweeptake_offers_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
