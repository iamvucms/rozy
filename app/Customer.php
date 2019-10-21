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
}
