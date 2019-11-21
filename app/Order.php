<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';
    public $fillable = ['status','id','name','address','phone','city','total'];
    public function OrderDetails(){
        return $this->hasMany('App\OrderDetail','idorder','id');
    }
    public function RlCustomer(){
        return $this->hasOne('App\Customer','id','idcus');
    }
    public function Customer(){
        return $this->hasOne('App\Customer','id','idcus')->first();
    }
    public function Coupon(){
        if($this->coupon_id===null){
            return null;
        }else{
            return $this->hasOne('App\Coupon','id','coupon_id')->first();
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
    public function City()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }
    public function getCity(){
        $cityName = $this->City()->first()->name;
        $cityName = str_replace("Tỉnh",'',$cityName);
        $cityName = str_replace("Thành phố",'',$cityName);
        return $cityName;
    }
    public function getShipPrice(){
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($this->getCity()),$api);
        $sellerApi = str_replace('YOUR_PLACE',urlencode($this->getSeller()->getCity()),$api);
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
    public function getLastCustomerOfSeller($seller_id){
        $dataCustomers = collect();
        $customers = $this->selectRaw('customers.id')
        ->join('customers','customers.id','=','orders.idcus')
        ->whereRaw('orders.idsell='.$seller_id)
        ->groupBy('customers.id')
        ->get();
        foreach($customers as $cus){
            $dataCustomers->push(Customer::where('id',$cus->id)->first());
        }
        return $dataCustomers;
    }
    public function getTotalValue(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $total = $this->sum('total');
        elseif($role_id==3)$total = $this
        ->where('idsell',$user->Seller()->id)->sum('total');
        return ceil($total/1000000);
    }
    public function getCountCompletedOrder(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count = $this->where('status','4')->count();
        elseif($role_id==3) $count = $this->where('idsell',$user->Seller()->id)->where('status','4')->count();
        return $count??0;
    }
    public function getCountWaitingOrder(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count = $this->where('status','1')->count();
        elseif($role_id==3) $count = $this->where('idsell',$user->Seller()->id)->where('status','1')->count();
        return $count??0;
    }
    public function getCountCancelOrder(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count = $this->where('status','5')->count();
        elseif($role_id==3) $count = $this->where('idsell',$user->Seller()->id)->where('status','5')->count();
        return $count??0;
    }
    public function getCountDeliveringOrder(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count = $this->where('status','3')->count();
        elseif($role_id==3) $count = $this->where('idsell',$user->Seller()->id)->where('status','3')->count();
        return $count??0;
    }
    public function getTotalPrice(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $total = $this->where('status','4')->sum('total');
        elseif($role_id==3)$total = $this->where('status','4')
        ->where('idsell',$user->Seller()->id)->sum('total');
        return ceil($total/1000000);
    }
    public function getTotalPriceToday(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $total = $this->where('status','4')->whereRaw("DAY(NOW())= DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->sum('total');
        elseif($role_id==3) $total = $this->where('status','4')->where('idsell',$user->Seller()->id)->whereRaw("DAY(NOW())= DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->sum('total');
        if($role_id==1) $totalYesterday = $this->where('status','4')->whereRaw("DAY(updated_at) = DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->sum('total');
        elseif($role_id==3) $totalYesterday = $this->where('status','4')->where('idsell',$user->Seller()->id)->whereRaw("DAY(updated_at) = DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->sum('total');
        return [ 'total'=>ceil($total/1000000),
            'percent' => $totalYesterday!=0 ?ceil($total/$totalYesterday*100) : 100
        ];
    }
    public function getNewOrderCount(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count =$this->whereRaw("DAY(NOW()) - DAY(created_at) <=5 AND MONTH(NOW())= MONTH(created_at) AND YEAR(NOW())= YEAR(created_at)")->count();
        elseif($role_id==3) $count =$this->where('idsell',$user->Seller()->id)->whereRaw("DAY(NOW()) - DAY(created_at) <=5 AND MONTH(NOW())= MONTH(created_at) AND YEAR(NOW())= YEAR(created_at)")->count();
        if($role_id==1) $precount = $this->whereRaw("DAY(NOW()) - DAY(created_at) <=10 AND DAY(NOW()) - DAY(created_at) >=5 AND MONTH(NOW())= MONTH(created_at) AND YEAR(NOW())= YEAR(created_at)")->count();
        elseif($role_id==3) $precount = $this->where('idsell',$user->Seller()->id)->whereRaw("DAY(NOW()) - DAY(created_at) <=10 AND DAY(NOW()) - DAY(created_at) >=5 AND MONTH(NOW())= MONTH(created_at) AND YEAR(NOW())= YEAR(created_at)")->count();
        return ['count'=>$count,'percent'=>$precount!=0 ?ceil($count/$precount*100) : 100];
    }
    public function getCompletedOrderCountToday(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $count = $this->where('status','4')->whereRaw("DAY(NOW()) = DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->count();
        elseif($role_id==3) $count = $this->where('idsell',$user->Seller()->id)->where('status','4')->whereRaw("DAY(NOW()) = DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->count();
        if($role_id==1) $precount = $this->where('status','4')->whereRaw("DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) = DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->count();
        elseif($role_id==3) $precount = $this->where('idsell',$user->Seller()->id)->where('status','4')->whereRaw("DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) = DAY(updated_at) AND MONTH(NOW())= MONTH(updated_at) AND YEAR(NOW())= YEAR(updated_at)")->count();
        return ['count'=>$count,'percent'=>$precount!=0 ?ceil($count/$precount*100) : 100];
    }
    public function getMoneyEachDay($month=1){
        $moneyChart = collect();
        $days = cal_days_in_month(CAL_GREGORIAN,date($month),date('Y'));
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $moneys = $this->selectRaw('SUM(total) as money,DAY(updated_at) as day')->whereRaw('MONTH(updated_at) ='.$month.' AND status=4')->groupBy('day')->get();
        elseif($role_id==3) $moneys = $this->selectRaw('SUM(total) as money,DAY(updated_at) as day')->where('idsell',$user->Seller()->id)->whereRaw('MONTH(updated_at) ='.$month.' AND status=4')->groupBy('day')->get();
        for($i=1;$i<=$days;$i++){
            $check = true;
            foreach($moneys as $money){
                if($money->day == $i){
                    $check = false;
                    $moneyChart->push(['money'=>$money->money,'day'=>$money->day]);
                    goto out;
                }
            }
            out:
            if($check){
                $moneyChart->push(['money'=>0,'day'=>$i]);
            }
            
        }
        return $moneyChart->toJson(JSON_HEX_APOS);
    }
}
