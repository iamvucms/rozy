<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;
use App\Product;
use App\Cart;

class Shipper extends Model
{
    protected $table = 'shippers';
    public function getShipPrice($place1,$place2){
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($place1),$api);
        $sellerApi = str_replace('YOUR_PLACE',urlencode($place2),$api);
        $result1 = json_decode(file_get_contents($buyerApi),true);
        $result2 = json_decode(file_get_contents($sellerApi),true);
        $buyerLocation = $result1['results'][0]['geometry']['location'];
        $sellerLocation = $result2['results'][0]['geometry']['location'];
        return $this->getDistance($buyerLocation,$sellerLocation) * $this->per_km;
    }
}
