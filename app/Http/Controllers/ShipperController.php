<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipper;
class ShipperController extends Controller
{
    public function getShipPrice(Request $req){
        $city = intval($req->city);
        $district = intval($req->district);
        $shipper = Shipper::find(intval($req->shipper));
        dd($shipper);
    } 
}
