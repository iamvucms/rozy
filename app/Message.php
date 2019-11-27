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
        return $this->hasOne('App\Customer','id','idcus')->with('Image');
    }
    public function myMessages(){
        $user = Auth::user();
        if($user) return $this->with('Seller')->with('Customer')->where('idcus',$user->getInfo()->id)->get();
        else return collect();
    }
    public function myCustomers($idsell){
        return $this->selectRaw('idcus,max(id) as idm')->where('idsell',$idsell)->groupBy('idcus')->orderBy('idm','DESC')->with('Customer')->get();
    }
    public function mySellers($idcus){
        return $this->selectRaw('idsell,max(id) as idm')->where('idcus',$idcus)->groupBy('idsell')->orderBy('idm','DESC')->with('Seller')->get();
    }
    public function getMessagesBySeller($idcus,$idsell){
        return $this->where('idsell',$idsell)->where('idcus',$idcus)->get();
    }
    public function getMessagesByCustomer($idcus,$idsell){
        return $this->where('idsell',$idsell)->where('idcus',$idcus)->get();
    }
}
