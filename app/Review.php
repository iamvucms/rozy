<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    public function Customer(){
        return $this->hasOne('App\Customer','id','idcus');
    }
    public function whoWrite(){
        return $this->Customer()->select('name')->first()->name;
    }
    public function Images(){
        return $this->hasMany('App\Image','id_review','id');
    }
    public function getImages(){
        return $this->Images()->select('src')->get();
    }
    public function Product()
    {
        return $this->belongsTo('App\Product', 'id', 'idpro');
    }
}
