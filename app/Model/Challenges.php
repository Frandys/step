<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{

    public function  Coupon(){

        return $this->hasOne('App\Model\MerchantCoupons', 'id', 'coupon_id');
    }


}
