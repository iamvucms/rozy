<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Keyword extends Model
{
    protected $table = 'keywords';
    protected $fillable = ['count','keyword'];
    public $timestamps = false;
    public function MostSearchKeyword(){
        $keys = $this->orderBy('count','DESC')->limit(10)->get();
        $products = [];
        foreach($keys as $key){
            if($key->idcat==0){
                $products[] = Product::where('name','like','%'.$key->keyword.'%')->first();
            }else{
                $products[] = Product::where('name','like','%'.$key->keyword.'%')->where('idcat',$key->idcat)->first();
            }
            
        }
        return array($keys->toArray(),$products);
    }
}
