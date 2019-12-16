<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Product;
class Alias extends Model
{
    protected $table = 'alias';
    public $timestamps = false;
    public static function GetTradeMarks($cat_id,$limit=13){
        $list = Product::select('id')->where('idcat',$cat_id)->get();
        $temp = [];
        foreach($list as $product) $temp[] = $product->id;
        $TradeMarks = DB::table('properties')->selectRaw('json->"$.thuonghieu" as name')->whereIn('id',$temp)->limit($limit)->get();
        return $TradeMarks;
    }
}
