<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];



    static function GetUserByMail($email) {
        return  $userData = static::whereEmail($email)->first();

    }

    public function  roles(){

     return   $this->belongsToMany('App\Model\Role','role_users','user_id','role_id');
    }

    public function  UserCoupan(){
        return $this->hasMany('App\Model\UserCoupon', 'user_id', 'id');
    }


    public function  UserMeta(){

        return   $this->hasOne('App\Model\UserMeta');
    }


    public function  MerchantMeta(){

        return   $this->hasOne('App\Model\MerchantMeta','id','user_id');
    }

}
