<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    protected $table = 'user_coupons';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'user_id',
        'merchant_coupons_id',
    );

    public function Merchant()
    {
        return $this->belongsTo('App\User', 'merchant_coupons_id', 'id');
    }

    public function MerchantMeta()
    {
        return $this->belongsTo('App\Model\MerchantMeta', 'merchant_coupons_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_id', 'id');
    }

}
