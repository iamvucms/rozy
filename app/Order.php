<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $fillable = ['status','id','name','address','phone','city','total'];
    public function OrderDetails(){
        return $this->hasMany('App\OrderDetail','idorder','id');
    }
    public function Coupon(){
        if($this->idcoupon===null){
            return null;
        }else{
            return $this->hasOne('App\Coupon','id','idcoupon')->first();
        }
    }
    public function Shipper(){
        return $this->hasOne('App\Shipper','id','idship');
    }
    public function getShipper(){
        return $this->Shipper()->first();
    }
    public function Seller()
    {   
        return $this->hasOne('App\Seller', 'id', 'idsell');
    }
    public function getSeller(){
        return $this->Seller()->first();
    }
    public function getShipPrice(){
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($this->city),$api);
        $sellerApi = str_replace('YOUR_PLACE',urlencode($this->getSeller()->city),$api);
        $result1 = json_decode(file_get_contents($buyerApi),true);
        $result2 = json_decode(file_get_contents($sellerApi),true);
        $buyerLocation = $result1['results'][0]['geometry']['location'];
        $sellerLocation = $result2['results'][0]['geometry']['location'];
        return $this->getDistance($buyerLocation,$sellerLocation) * $this->getShipper()->per_km;
    }
    public function getOrderDetails(){
        return $this->OrderDetails()->get();
    }
    public function getProductsPrice(){
        $orderdetails = $this->getOrderDetails();
        $productsPrice = 0;
        foreach($orderdetails as $od){
            $productsPrice += $od->getProductPrice();
        }
        return $productsPrice;
    }
    public function getDistance($p1,$p2){
        $R = 6378137; // Earth’s mean radius in meter
        $dLat = deg2rad($p2['lat'] - $p1['lat']);
        $dLong = deg2rad($p2['lng'] - $p1['lng']);
        $a = sin($dLat / 2) * sin($dLat / 2) +
          cos(deg2rad($p1['lat'])) * cos(deg2rad($p2['lat'])) *
          sin($dLong / 2) * sin($dLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c;
        return round($d/1000); // returns the distance in meter
    }
}
