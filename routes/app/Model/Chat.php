<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $dateFormat = 'U';

    protected $table = 'chats';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'user_id',
        'tickets_id',
        'chat',
        'updated_at',
        'created_at',
    );


    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
