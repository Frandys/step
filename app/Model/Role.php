<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'roles';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'slug',
        'name',
        'permissions',

    );

    public function  users(){



       // return   $this->belongsToMany('App\Model\Role','role_users','user_id','role_id');

        return   $this->belongsToMany('App\User');
    }
}
