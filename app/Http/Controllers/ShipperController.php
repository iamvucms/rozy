<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipper;
use App\City;
use App\District;
class ShipperController extends Controller
{
    public function getShipPrice(Request $req){
        $city = City::find(intval($req->city));
        $district = District::find(intval($req->district));
        $shipper = Shipper::find(intval($req->shipper));
        return $shipper->getRealShipPrice($shipper,$district,$city,$req->pureAddress);
    }
}
