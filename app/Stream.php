<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $table = 'streams';
    protected $fillable = ['idsell','stream_key','status','idcat','description'];
    public function Seller(){
        return $this->hasOne('App\Seller','id','idsell');
    }
    public function Category(){
        return $this->hasOne('App\Category','id','idcat');
    }
}
