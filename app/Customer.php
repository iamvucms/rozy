<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = ['name','phone','address','gender'];
    public function Image(){
        return $this->hasOne('App\Image','id_avt_user','user_id');
    }
    public function getCountNewCustomer(){
        $total = $this->whereRaw("DATEDIFF(now(),create_at) < 5")->count();
        $pre = $this->whereRaw("DATEDIFF(now(),create_at) > 5 AND DATEDIFF(now(),create_at) <= 10")->count();
        return [ 'total'=>ceil($total/1000000),
            'percent' => $pre!=0 ?ceil($total/$pre*100) : 100
        ];
    }
    public function getCountCustomerByType($type=0){
        $total = $this->where('group_type',$type)->count();
        return $total;
    }
    public function User(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function getAvatar(){
        return $this->Image()->first()->src ?? 'https://vignette.wikia.nocookie.net/medium/images/d/de/Unknown_Man.png/revision/latest?cb=20130607213749';
    }
    public function Reviews(){
        return $this->hasMany('App\Review','idcus','id');
    }
    public function getCountReviews(){
        return $this->Reviews()->count();
    }
    public function Orders(){
        return $this->hasMany('App\Order','idcus','id');
    }
    public function getTotalPaid(){
        return $this->Orders()->sum('total') ?? 0;
    }
    public function allOrder($status=0){
        if($status==0){
            return $this->Orders()->with('Seller')->orderBy('id','DESC')->get();
        }else{
            return $this->Orders()->with('Seller')->orderBy('id','DESC')->where('status',$status)->get();
        }
    }
}
