<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $fillable = ['status','id','name','address','phone'];
    public function OrderDetails(){
        return $this->hasMany('App\OrderDetail','idorder','id');
    }
    public function Shipper(){
        return $this->hasOne('App\Shipper','id','idship');
    }
    public function Seller()
    {   
        return $this->hasOne('App\Seller', 'id', 'idsell');
    }
    public function getOrderDetails(){
        return $this->OrderDetails()->get();
    }

}
