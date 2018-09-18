<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUsers extends Model
{
    protected $table = 'role_users';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'user_id',
        'role_id',
    );


public function user()
{
    return $this->belongsTo('App\User', 'id', 'user_id');
}

    public function roles()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
