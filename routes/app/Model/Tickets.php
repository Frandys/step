<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $dateFormat = 'U';

    public function  UserChat(){

        return   $this->belongsToMany('App\User','chats','user_id','tickets_id')->withPivot('chat');
    }

    public function  UserChatAdd(){

        return   $this->belongsToMany('App\User','chats','tickets_id','user_id')->withPivot('chat');
    }
}
