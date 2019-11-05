<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Commune;
use App\District;
class AddressController extends Controller
{
    public function getMore(Request $req){
        if(intval($req->city)>0){
           $city = City::where('id',intval($req->city))->first();
           return $city->Districts()->get()->toJson();
        }
        if(intval($req->district)>0){
            $district = District::where('id',intval($req->district))->first();
           return $district->Communes()->get()->toJson();
        }
        return json_encode([]);
    }
}
