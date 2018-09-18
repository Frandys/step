<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MerchantMeta extends Model
{
    protected $primaryKey = 'user_id';

    protected $dateFormat = 'U';
    protected $fillable = [
        'age',
        'address',
        'phone',
        'photo',
        'discription',
        'rating',
        'user_id',
    ];


    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
