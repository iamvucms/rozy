<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public function OrderDetails(){
        return $this->hasMany('App\OrderDetail','idorder','id');
    }
}
