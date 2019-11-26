<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    public function Seller(){
        return $this->hasOne('App\Seller','id','idsell')->with('Avatar');
    }
    public function Customer(){
        return $this->hasOne('App\Customer','id','idcus');
    }
    public function myMessages(){
        $user = Auth::user();
        if($user) return $this->with('Seller')->with('Customer')->where('idcus',$user->getInfo()->id)->get();
        else return collect();
    }
    public function mySellers($idcus){
        return $this->select('idsell')->where('idcus',$idcus)->groupBy('idsell')->with('Seller')->get()->reverse();
    }
    public function getMessagesBySeller($idcus,$idsell){
        return $this->where('idsell',$idsell)->where('idcus',$idcus)->get();
    }
}
