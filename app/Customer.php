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
    public function getAvatar(){
        return $this->Image()->first()->src ?? null;
    }
    public function Orders(){
        return $this->hasMany('App\Order','idcus','id');
    }
    public function allOrder($status=0){
        if($status==0){
            return $this->Orders()->get();
        }else{
            return $this->Orders()->where('status',$status)->get();
        }
    }
}
