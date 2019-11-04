<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shipper;
class ShipperController extends Controller
{
    public function Shipper(Request $req,$id){
        return dd(Shipper::where('id',$id)->first());
    }
}
