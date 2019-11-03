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
    public function User(){
        return $this->hasOne('App\User','id','user_id')->first();
    }
    public function getAvatar(){
        return $this->Image()->first()->src ?? 'https://vignette.wikia.nocookie.net/medium/images/d/de/Unknown_Man.png/revision/latest?cb=20130607213749';
    }
    public function Orders(){
        return $this->hasMany('App\Order','idcus','id');
    }
    public function allOrder($status=0){
        if($status==0){
            return $this->Orders()->orderBy('id','DESC')->get();
        }else{
            return $this->Orders()->orderBy('id','DESC')->where('status',$status)->get();
        }
    }
}
