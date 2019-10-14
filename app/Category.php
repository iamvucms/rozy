<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function Products(){
        return $this->hasMany('App\Product','idcat','id');
    }
    public function getProducts(){
        return $this->Products()->get();
    }
    public function getTrendProducts($limit=13){
        return $this->Products()->selectRaw('products.*')
        ->join('orderdetails','products.id','=','orderdetails.idpro')
        ->groupBy('products.id')->orderByRaw('SUM(orderdetails.quantity) DESC')->limit($limit)->get();
    }
}
