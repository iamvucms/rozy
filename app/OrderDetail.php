<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    public function Product(){
        return $this->hasOne('App\Product', 'id', 'idpro');
    }
    public function getProduct(){
        return $this->Product()->first();
    }
    public function getProductPrice(){
        return $this->getProduct()->first()->sale_price * $this->quantity;
    }
}
