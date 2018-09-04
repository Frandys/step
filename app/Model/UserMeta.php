<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $primaryKey = 'user_id';
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
