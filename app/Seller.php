<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\City;
use App\District;
use App\Coupon;
use App\Review;
class Seller extends Model
{
    protected $table = 'sellers';
    
    public function Products(){
        return $this->hasMany('App\Product','idsell','id');
    }
    public function User(){
        return $this->hasOne('App\User','id','user_id')->first();
    }
    public function Reviews(){
        return $this->Products()->select('reviews.*')->join('reviews','products.id','=','reviews.id');
    }
    public function getCountReviewToday(){
        $total = $this->Reviews()->whereRaw('DAY(reviews.create_at)=DAY(now()) AND MONTH(reviews.create_at)=MONTH(now()) AND YEAR(reviews.create_at)=YEAR(now())')->count();
        $pre = $this->Reviews()->whereRaw('DAY(reviews.create_at)=DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) AND MONTH(reviews.create_at)=MONTH(now()) AND YEAR(reviews.create_at)=YEAR(now())')->count();
        return [ 'total'=>$total,
            'percent' => $pre!=0 ? ceil($total/$pre*100) : 100
        ];
    }
    public function getAvgPointReview(){
        return $total = $this->Reviews()->avg('point') ?? 0;
    }
    public function getCountGoodReview(){
        return $this->Reviews()->whereRaw('star > 3')->count();
    }
    public function getCountBadReview(){
        return $this->Reviews()->whereRaw('star < 3')->count();
    }
    public function getAvgReview(){
        return $total = $this->Reviews()->avg('star') ?? 0;
    }
    public function getReviews(){
        $collection = collect();
        $data = $this->Products()->select('reviews.id')->join('reviews','products.id','=','reviews.id')->get();
        foreach($data as $rv){
            $collection->push(Review::find($rv->id));
        }
        return $collection;
    }
    public function getProducts($pagination=20){
        return $this->Products()->orderBy('id','DESC')->paginate($pagination);
    }
    public function Avatar(){
        return $this->hasOne('App\Image','id_avt_seller','id');
    }
    public function Cover(){
        return $this->hasOne('App\Image','id_cover_seller','id');
    }
    public function getAvatar(){
        return $this->Avatar()->first()->src ?? '';
    }
    public function getCover(){
        return $this->Cover()->first()->src ?? '';
    }
    public function getTotalProducts(){
        return $this->Products()->count() ?? 0;
    }
    public function Coupons()
    {
        return $this->hasMany('App\Coupon', 'idsell', 'id');
    }
    public function getAvailableCoupon(){
        return $this->Coupons()->whereRaw('expired > now() AND max_using>0')->get();
    }
    public function checkCoupon($coupon){
        return $this->Coupons()->whereRaw('expired > now() AND max_using>0')
        ->where('code',$coupon)->count()>0;
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
    public function District()
    {
        return $this->hasOne('App\District', 'id', 'district_id');
    }
    public function getDistrict(){
        $districtName = $this->District()->first()->name;
        $districtName = str_replace("Quận",'',$districtName);
        $districtName = str_replace("Huyện",'',$districtName);
        $districtName = str_replace("Thị Xã",'',$districtName);
        return $districtName;
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
    public function getAddressText(){
        $cityName = $this->getCity();
        $districtName = $this->getDistrict();
        return $districtName.', '.$cityName;
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
 