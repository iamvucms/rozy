<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Discount extends Model
{
    protected $table = 'discount';

    public function Product(){
        return $this->hasOne('App\Product','id','idproduct')->first();
    }
    public function Flashsales(){
        $current = date("Y-m-d");
        $discounts = $this->selectRaw("discount.idproduct, max(discount.percent) as max")
        ->join('products','discount.idproduct','=','products.id')
        ->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('discount.total - discount.selled >0')
        ->groupBy('discount.idproduct')->get();
        $temps = [];
        foreach($discounts as $discount){
            $temps[] = $this->where('idproduct',$discount->idproduct)
            ->where('percent',$discount->max)
            ->first();
        }
        return $temps;
    }
}
