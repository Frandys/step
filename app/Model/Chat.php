<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'user_id',
        'role_id',
    );


    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
