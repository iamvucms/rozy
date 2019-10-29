<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Discount extends Model
{
    protected $table = 'discount';

    public function Product(){
        return $this->hasOne('App\Product','id','idproduct')->first();
    }
    public function Flashsales(){
        $current = date("Y-m-d H:i:s");
        $discounts = $this->selectRaw("discount.idproduct, max(discount.percent) as max")
        ->join('products','discount.idproduct','=','products.id')
        ->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('discount.total - discount.selled > 0')
        ->groupBy('discount.idproduct')->get();
        $temps = [];
        foreach($discounts as $discount){
            $disc = $this->where('idproduct',$discount->idproduct)
            ->where('percent',$discount->max)
            ->where([['from','<',$current],['to','>',$current]])
            ->whereRaw('discount.total - discount.selled > 0')
            ->first();
            $temps[] = $disc;
        }
        return $temps;
    }
    public function DiffTime(){
        $current = Carbon::now('Asia/Ho_Chi_Minh');
        $finish = Carbon::parse($this->to,'Asia/Ho_Chi_Minh');
        $result = [];
        $result['rmHours'] = $finish->diffInHours($current);
        $finish = $finish->subHours($result['rmHours']);
        $result['rmMins'] = $finish->diffInMinutes($current);
        $finish = $finish->subMinutes($result['rmMins']);
        $result['rmSeconds'] = $finish->diffInSeconds($current);
        return $result;
    }
}
