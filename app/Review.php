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
    public function getNewReviewCount(){
        $count =$this->whereRaw("DAY(NOW()) - DAY(create_at) <=5 AND MONTH(NOW())= MONTH(create_at) AND YEAR(NOW())= YEAR(create_at)")->count();
        $precount =$this->whereRaw("DAY(NOW()) - DAY(create_at) >=5 AND DAY(NOW()) - DAY(create_at) <=10 AND MONTH(NOW())= MONTH(create_at) AND YEAR(NOW())= YEAR(create_at)")->count();
        return ['count'=>$count,'percent'=>$precount!=0 ?ceil($count/$precount*100) : 100 ];;
    }
    public function getCountEachStar(){
        $dataReview = $this->selectRaw('count(reviews.id) as count,star')
        ->groupBy('star')->get();
        return $dataReview->toJson();
    }
}
