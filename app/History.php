<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $table = 'history';
    public function User(){
        return $this->hasOne('App\User','id','user_id')->first();
    }
    public function Customer(){
        return $this->hasOne('App\Customer','user_id','user_id')->first();
    }
}
