<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use App\Product;
use App\Seller;

class Enjoy extends Model
{
    /*
    @param type ==1 =>Product
    @param type ==2 =>Shop
    */
    private $enjoy;
    public function __construct(){
        parent::__construct();
        $this->enjoy = json_decode(Cookie::get('enjoy'),true) ?? [];
    }
    public function addItem($id,$type){
        $object = null;
        if($type==1){
            $object =Product::where('id',$id)->first();
            
        }elseif($type==2){
            $object =Seller::where('id',$id)->first();
        }else return false;
        if($object->count()==0) return false;
        $exists = $this->is_exists($id,$type);
        if(!$exists){
            
            $this->enjoy[]=[
                'id' =>$id,
                'type' =>$type
            ];
            
        }
        
        $this->saveEnjoy();
        
        return true;
    }
    public function delItem($id,$type=1){
        foreach ($this->enjoy as $key => $item) {
            if($item['id']==$id && $item['type']==$type){
                array_splice($this->enjoy,$key,1);
                $this->saveEnjoy();
                return true;
            }
        }
        return false;
    }
    public function getEnjoy(){
        return $this->enjoy;
    }
    public function count(){
        return count($this->enjoy);
    }
    public function getType($id){
        foreach($this->enjoy as $obj){
            if($id==$obj['id']) return $obj['type'];
        }
        return 0;
    }
    public function is_exists($id,$type=1){
        $check = false;
        foreach($this->enjoy as $obj){
            if($obj['id']==$id && $obj['type']==$type){
                $check = true;
                break;
            }
        }
        return $check;
    }
    private function saveEnjoy(){
        Cookie::queue('enjoy',json_encode($this->enjoy),999999999);
    }
}
