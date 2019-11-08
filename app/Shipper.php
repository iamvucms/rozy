<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;
use App\Product;
use App\Cart;
use App\District;
use App\City;

class Shipper extends Model
{
    protected $table = 'shippers';
    public function getRealShipPrice($shipper,$city,$district,$pureAddress=null){
        $cart = (new Cart)->getProductPerSeller();
        $per_km = intval($shipper->per_km);
        if($pureAddress) $fullAddress =$pureAddress;
        else $fullAddress = $district->name.', '.$city->name;
        $shipPrices = collect();
        foreach($cart as $perSeller){
            $seller = Product::find($perSeller[0]['id'])->Seller();
            $shipPrices->push([
                'idsell'=>$seller->id,
                'price'=>$this->getShipPrice($seller->getAddressText(),$fullAddress),
                'inDay'=>2+round($this->getShipPrice($seller->getAddressText(),$fullAddress,true)/800)
            ]);
        }
        return $shipPrices->toJson();
    }
    public function getRealShipPriceBySeller($seller,$shipper,$city,$district,$pureAddress=null){
        $per_km = intval($shipper->per_km);
        if($pureAddress) $fullAddress =$pureAddress;
        else $fullAddress = $district->name.', '.$city->name;
        $shipPrice = $this->getShipPrice($seller->getAddressText(),$fullAddress);
        return $shipPrice;
    }
    public function getShipPrice($place1,$place2,$returnKm = false){
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($place1),$api);
        $sellerApi = str_replace('YOUR_PLACE',urlencode($place2),$api);
        $result1 = json_decode(file_get_contents($buyerApi),true);
        $result2 = json_decode(file_get_contents($sellerApi),true);
        $buyerLocation = $result1['results'][0]['geometry']['location'];
        $sellerLocation = $result2['results'][0]['geometry']['location'];
        if($returnKm) return $this->getDistance($buyerLocation,$sellerLocation);
        $price = $this->getDistance($buyerLocation,$sellerLocation) * $this->per_km;
        if($price > 5000){
            if($price<40000){
                return $price;
            }else return 40000;
        }else return 5000;
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
