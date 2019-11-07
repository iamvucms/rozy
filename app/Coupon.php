<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    public function getAvailable(){
        return $this->whereRaw('expired > now() AND max_using>0 AND idsell=0')->get();
    }
    public function checkPublicCoupon($coupon){
        return $this->whereRaw('expired > now() AND max_using>0 AND idsell=0')->where('code',$coupon)->get();
    }
}
