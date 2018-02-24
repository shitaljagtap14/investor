<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property mixed id
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed is_admin
 * @property mixed name
 * @property mixed email
 * @property mixed auth_token
 * @property mixed is_verified
 * @property mixed verification_token
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'is_admin', 'email', 'password', 'is_verified', 'verification_token', 'braintree_id', 'paypal_email', 'card_brand', 'card_last_four', 'trial_ends_at', 'deleted_at'
    ];

    /**
     * The attributes that are timestaps.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* public function sweeptakeOffer()
     {
         return $this->belongsToMany(SweeptakeOffer::class);
     }*/
//for find the number of participate
    public function sweeptakeOffer()
    {
        return $this->belongsToMany(SweeptakeOffer::class, 'user_sweeptake_offers', 'users_id', 'sweeptake_offers_id');

    }
    //for transaction history of particular user

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionuser()
    {
        return $this->hasMany(Transactions::class, 'users_id', 'users_id');

    }


}
