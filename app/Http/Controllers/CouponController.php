<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Cart;
use App\Seller;
use Session;
class CouponController extends Controller
{
    public function check(Request $req){
        $sessCoupons = Session::get('coupons') ?? [];
        $coupon = trim($req->coupon);
        $objCp = new Coupon();
        $checkPublic  = $objCp->checkPublicCoupon($coupon);
        if($checkPublic->count()==0){
            $cart = new Cart();
            $sellers = $cart->getSellers();
            foreach($sellers as $id){
                $sell = Seller::find($id);
                if($sell->checkCoupon($coupon)){
                    $cp = Coupon::where('code',$coupon)->first();
                    if(!$this->checkExists($coupon,$sell->id)){
                        $sessCoupons[] = [
                            'idsell'=>$sell->id,
                            'coupon'=>$coupon,
                            'value'=>$cp->value
                        ];
                    };
                }
            }
        }else{
            if(!$this->checkExists($coupon,0)){
                $cp = Coupon::where('code',$coupon)->first();
                $sessCoupons[] = [
                    'idsell'=>0,
                    'coupon'=>$coupon,
                    'value'=>$cp->value
                ];
            };
        }
        Session::put('coupons',$sessCoupons);
        return redirect()->back();
    }
    public function checkExists($coupon,$id){
        $sessCoupons = Session::get('coupons') ?? [];
        foreach($sessCoupons as $cp){
            if($cp['idsell']== $id && $cp['coupon']==$coupon) return true;
        }
        return false;
    }
}
