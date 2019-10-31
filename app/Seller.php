<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\City;

class Seller extends Model
{
    protected $table = 'sellers';
    
    public function Products(){
        return $this->hasMany('App\Product','idsell','id');
    }
    public function getProducts($pagination=20){
        return $this->Products()->orderBy('id','DESC')->paginate($pagination);
    }
    public function getAvatar(){
        return $this->hasOne('App\Image','id_avt_seller','id')->first()->src ?? '';
    }
    public function getCover(){
        return $this->hasOne('App\Image','id_cover_seller','id')->first()->src ?? '';
    }
    public function getTotalProducts(){
        return $this->Products()->count() ?? 0;
    }
    public function Orders(){
        return $this->hasMany('App\Order','idsell','id');
    }
    public function getTotalSelled(){
        $total = 0;
        $orders = $this->Orders()->get();
        foreach($orders as $order){
            $total +=$order->OrderDetails()->sum('quantity');
        }
        return $total;
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
    public function getTotalProductsViewed(){
        $total = 0;
        $Products = $this->Products()->get();
        foreach($Products as $product){
            $total +=$product->viewe_count;
        }
        return $total;
    }
    public function getTotalReviewsThan($star=0){
        $total = 0;
        $products = $this->Products()->get();
        foreach($products as $product){
            $total +=$product->getCountReview($star);
        }
        return $total;
    }
    public function JoinTime(){
        $datejoin = new Carbon($this->join_at);
        $now = Carbon::now();
        return $datejoin->diffInDays($now);
    }
    public static function filterAddress(){
        $ids = DB::table('sellers')->select('city_id')->distinct()->get();
        $temp = [];
        foreach($ids as $id){
            $temp[]= $id->city_id;
        }
        $addrs = City::whereIn('id',$temp)->get();
        return $addrs;
    }
}
 