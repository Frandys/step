<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    static function GetUserByMail($email) {
        return  $userData = static::whereEmail($email)->first();

    }

    public function  roles(){

     return   $this->belongsToMany('App\Model\Role','role_users','user_id','role_id');
    }


}
