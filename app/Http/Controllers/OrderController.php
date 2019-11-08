<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use App\Seller;
use App\Product;
use App\Shipper;
use App\City;
use App\Coupon;
use App\District;
use Session;
use App\OrderDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public function OrderStatus(Request $req,$id){
        $orderData = $req->validate([
            'status' => 'required|min:1|max:5',
        ]);
        $order = Order::where('id',$id)->first();
        if($order->count()==0 || $order->status==4) return response()->json(['success'=>false], 200, []);
        if(Auth::user()->getInfo()->id != $order->idcus) return response()->json(['success'=>false], 200, []);
        if($order->status<3){
            $order->status = $orderData['status'];
            $order->save();
        }
        return response()->json(['success'=>true], 200, []);
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:2',
            'phone' => 'required|digits:10',
            'city'=>'required|numeric',
            'district'=>'required|numeric',
            'commune'=>'required|numeric',
            'street'=>'required|min:2',
            'shipType'=>'required|',
            'payType'=>'required|numeric',
        ]);
        if ($validator->fails()){
            $errors = $validator->errors();
            $fields = [];
            if($errors->has('name')){
                $fields[] = 'name';
            }
            if($errors->has('phone')){
                $fields[] = 'phone';
            }
            if($errors->has('city') && $req->city !=0){
                $fields[] = 'city';
            }
            if($errors->has('district') && $req->district !=0){
                $fields[] = 'district';
            }
            if($errors->has('commune') && $req->commune !=0){
                $fields[] = 'commune';
            }
            if($errors->has('street') && $req->street !=0){
                $fields[] = 'street';
            }
            if($errors->has('shipType') ){
                $fields[] = 'shipType';
            }
            if($errors->has('payType')){
                $fields[] = 'payType';
            }
            if(count($fields)>0) return response()->json(['success'=>false,'field'=>$fields], 200, []);
        }
        $user = Auth::user();
        $coupons = Session::get('coupons');
        $cart = new Cart;
        $products = $cart->getProductPerSeller();
        $cartPrice = $cart->getTotal();
        foreach($products as $prod){
            $order = new Order;
            $order->slug = Str::uuid()->toString();
            $order->idcus = $user->getInfo()->id;
            $order->idShip = $req->shipType;
            $seller = Product::find($prod[0]['id'])->Seller();
            $idsell = $seller->id;
            $order->idsell = $idsell;
            $cpPrice = 0;
            foreach($coupons as $key=>$cp){
                $cpObj = Coupon::where('code',$cp['coupon'])->whereRaw('max_using>0 AND NOW() > expired')->first();
                if($cp['idsell'] == $idsell || $cp['idsell']==0 && $cpObj) $cpPrice+= $cp['value'];
                unset($coupons[$key]);
                if($cpObj){
                    $cpObj->max_using =  $cpObj->max_using-1;
                    $cpObj->save();
                }
            }
            $t = 0;
            $shipper = Shipper::find($req->shipType);
            $city = City::find($req->city);
            $district = District::find($req->district);
            if($city && $district){
                $shipPrice = $shipper->getRealShipPriceBySeller($seller,$shipper,$city,$district);
            }else{
                $shipPrice = $shipper->getRealShipPriceBySeller($seller,$shipper,$city,$district,$user->getInfo()->address);
            }
            
            foreach($prod as $p) $t+=$p['price']*$p['quantity'];
            $order->total = $shipPrice+$t-$cpPrice;
            echo $shipPrice+$t-$cpPrice.'<br>';
        }
        Session::forget('coupons');
        return response()->json(['success'=>true], 200, []);
    }
}
