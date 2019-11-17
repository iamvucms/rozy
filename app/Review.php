<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Review extends Model
{
    protected $table = 'reviews';
    public $timestamps = false;
    public function Customer(){
        return $this->hasOne('App\Customer','id','idcus');
    }
    public function getCountReviewToday(){
        $total = $this->whereRaw('DAY(reviews.create_at)=DAY(now()) AND MONTH(reviews.create_at)=MONTH(now()) AND YEAR(reviews.create_at)=YEAR(now())')->count();
        $pre = $this->whereRaw('DAY(reviews.create_at)=DAY(ADDDATE(NOW(),INTERVAL -1 DAY)) AND MONTH(reviews.create_at)=MONTH(now()) AND YEAR(reviews.create_at)=YEAR(now())')->count();
        return [ 'total'=>$total,
            'percent' => $pre!=0 ? ceil($total/$pre*100) : 100
        ];
    }
    public function getAvgPointReview(){
        return $total = $this->avg('point') ?? 0;
    }
    public function getCountGoodReview(){
        return $this->whereRaw('star > 3')->count();
    }
    public function getCountBadReview(){
        return $this->whereRaw('star < 3')->count();
    }
    public function getAvgReview(){
        return $total = $this->avg('star') ?? 0;
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
        return $this->belongsTo('App\Product', 'idpro', 'id');
    }
    public function getNewReviewCount(){
        $count =$this->whereRaw("DAY(NOW()) - DAY(create_at) <=5 AND MONTH(NOW())= MONTH(create_at) AND YEAR(NOW())= YEAR(create_at)")->count();
        $precount =$this->whereRaw("DAY(NOW()) - DAY(create_at) >=5 AND DAY(NOW()) - DAY(create_at) <=10 AND MONTH(NOW())= MONTH(create_at) AND YEAR(NOW())= YEAR(create_at)")->count();
        return ['count'=>$count,'percent'=>$precount!=0 ?ceil($count/$precount*100) : 100 ];;
    }
    public function getCountEachStar(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $dataReview = $this->selectRaw('count(reviews.id) as count,star')
        ->groupBy('star')->get();
        elseif($role_id==3) $dataReview = $this->selectRaw('count(reviews.id) as count,star')
        ->join('products','products.id','=','reviews.idpro')->whereRaw('products.idsell='.$user->Seller()->id)
        ->groupBy('star')->get();
        return $dataReview->toJson();
    }
}
