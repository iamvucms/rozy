<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Category;
class Product extends Model
{
    protected $table = 'products';
    
    //RecommandProduct
    public function ProductForYou($limit){
        $category = new Category();
        $cats = $category->recommandCategories(1);
        $equalCat =[];
        foreach($cats as $cat){
            $equalCat[] = $cat->id;
        }
        $products = $this->whereIn('idcat',$equalCat)->limit($limit)->get();
        return $products;        
    }
    //Discount Relationship
    public function Discount()
    {
        return $this->hasMany('App\Discount', 'idproduct', 'id');
    }
    public function AvailableDiscount()
    {
        $current = date("Y-m-d");
        return $this->Discount()->select("percent")
        ->where([['from','<',$current],['to','>',$current]])
        ->whereRaw('(discount.total - discount.selled >0 OR (total IS NULL AND selled IS NULL))')
        ->orderBy('percent','DESC')->limit(1);
    }
    //Review Relationship
    public function Review(){
        return $this->hasMany('App\Review','idpro','id');
    }
    public function getCountReview($star=0){
        return $this->Review()->where('star','>',$star)->count();
    }
    public function getCountReviewAt($star=1){
        return $this->Review()->where('star','=',$star)->count();
    }
    public function getAvgReview(){
        return round($this->Review()->avg('star'));
    }
    public function getReviews(){
        return $this->Review()->orderBy('reviews.create_at','desc')->paginate(5);
    }
    public function getPercentReview(){
        $stars = [];
        $TotalStars = $this->getCountReview();
        for($i=1;$i<=4;$i++){
            $stars[] = $TotalStars !=0 ? round($this->getCountReviewAt($i)/$TotalStars*100) :0;
        }
        $stars[] = $TotalStars !=0 ? 100- array_sum($stars) :0;
        $stars = array_reverse($stars);
        return $stars;
    }
    //OrderDetail Relationship
    public function OrderDetail(){
        return $this->hasMany('App\OrderDetail','idpro','id');
    }
    public function getTotalQuantitySelled(){
        return $this->OrderDetail()->sum('quantity');
    }
    public function isTrending(){
        
    }
    //Images relationships
    public function Images(){
        return $this->hasMany('App\Image','id_product','id')->select('src')->whereNull('id_avt_product')->get();
    }
    public function Avatar(){
        return $this->hasOne('App\Image','id_avt_product','id')->select('src')->first();
    }
    //Seller Relationships
    public function Seller(){
        return $this->hasOne('App\Seller','id','idsell')->first();
    }
    public function isNew($datediff=15){
        $products = $this->whereRaw("DATEDIFF(now(),create_at) >0 AND DATEDIFF(now(),create_at) < $datediff")->where('id',$this->id);
        return $products->count()>0;
    }
    //Property Relationships
    public function Property(){
        return $this->hasOne('App\Property','id','id');
    }
    public function getProps(){
        $props = json_decode($this->Property()->select('json')->first()->json ?? "[]",true);
        return $props;
    }
    public function Category(){
        return $this->hasOne('App\Category','id','idcat');
    }
    public function getCategory(){
        return $this->Category()->first();
    }
    //Product For Filter
    public function search($cat,$keyword){
        $temp = $this;
        if($keyword!==null) $temp = $temp->where('name','like',"%$keyword%");
        if(!($cat==0 || $cat===null)) $temp = $temp->where('idcat',$cat);
        return $temp;
    }   
    public function withPrice($cat,$keyword,$from,$to){
        if($from===null) $from = 0;
        if($to===null) $to = PHP_INT_MAX;
        return $this->search($cat,$keyword)->where([['sale_price','>=',$from],['sale_price','<=',$to]]);
    }
    public function withPriceAddress($cat,$keyword,$from,$to,$address){
        if($address===null) $address = '';
        return $this->withPrice($cat,$keyword,$from,$to)->where('city_address','like',"%$address%");
    }
    public function withPriceAddressReview($cat,$keyword,$from,$to,$address,$star){
        if($star===null) return $this->withPriceAddress($cat,$keyword,$from,$to,$address);
        return $this->withPriceAddress($cat,$keyword,$from,$to,$address)
        ->select('products.*')->join('reviews','reviews.idpro','=','products.id')
        ->groupBy('reviews.idpro')->havingRaw('avg(star) >= '.$star);
    } 
    public function withPriceAddressReviewOrder($cat,$keyword,$from,$to,$address,$star,$order){
        if($order===null) $order = 'ASC';
        return $this->withPriceAddressReview($cat,$keyword,$from,$to,$address,$star)
        ->orderBy('price',$order);
    }
    public function getCountAfterFilter($cat,$keyword,$from,$to,$address,$star){
        return $this->withPriceAddressReview($cat,$keyword,$from,$to,$address,$star)
        ->count();
    }
    public function ProductFilter($cat,$keyword,$from,$to,$address,$star,$order){
        return $this->withPriceAddressReview($cat,$keyword,$from,$to,$address,$star,$order)
        ->paginate(20);
    }
}
