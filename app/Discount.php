<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Discount extends Model
{
    protected $table = 'discount';
    public $timestamps = false;
    public function RlProduct(){
        return $this->hasOne('App\Product','id','idproduct');
    }
    public function Product(){
        return $this->RlProduct()->first();
    }
    public function getBeDiscountCount(){
        return $this->distinct('idproduct')->count();
    }
    public function getFlashSaleCount(){
        return $this->whereRaw('discount.total is not null and discount.selled is not null')->count();
    }
    public function Flashsales(){
        $current = date("Y-m-d H:i:s");
        $discounts = $this->selectRaw("discount.idproduct, max(discount.percent) as max")
        ->join('products','discount.idproduct','=','products.id')
        ->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('discount.total - discount.selled > 0')
        ->groupBy('discount.idproduct')->get();
        $temps = collect();
        foreach($discounts as $discount){
            $disc = $this->where('idproduct',$discount->idproduct)->with('RlProduct')
            ->where('percent',$discount->max)
            ->where([['from','<',$current],['to','>',$current]])
            ->whereRaw('discount.total - discount.selled > 0')
            ->first();
            $temps->push($disc);
        }
        return $temps;
    }
    public function getMaxAvailablerForProduct($idproduct){
        $current = date("Y-m-d H:i:s");
        return $this->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('(discount.total - discount.selled > 0 OR (discount.total is null AND discount.selled is null))')
        ->where('idproduct',$idproduct)
        ->max('percent') ?? 0;
    }
    public function getAvailableCount(){
        $current = date("Y-m-d H:i:s");
        return $this->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('(discount.total - discount.selled > 0 OR (discount.total is null AND discount.selled is null))')->count();
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
