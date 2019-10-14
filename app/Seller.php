<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
    
    public function Products(){
        return $this->hasMany('App\Product','idsell','id');
    }
    public function getTotalProducts(){
        return $this->Products()->count();
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
    public function getTotalReviewsThan($star=0){
        $total = 0;
        $products = $this->Products()->get();
        foreach($products as $product){
            $total +=$product->getCountReview($star);
        }
        return $total;
    }
}
 