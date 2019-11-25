<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    public $timestamps = false;
    public function Product(){
        return $this->hasOne('App\Product', 'id', 'idpro')->with('ImgAvt');
    }
    public function Order(){
        return $this->hasOne('App\Order','id','idorder');
    }
    public function getProduct(){
        return $this->Product()->first();
    }
    public function getProductPrice(){
        return $this->getProduct()->first()->sale_price * $this->quantity;
    }
}
