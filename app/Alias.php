<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Alias extends Model
{
    protected $table = 'alias';

    public static function GetTradeMarks($cat_id=1,$limit=13){
        $idTradeMark = DB::table('alias')->where('idcat',$cat_id)->where('alias','Thương Hiệu')->first()->prop ??'';
        $TradeMarks = DB::table('properties')->selectRaw('json->"$.'.$idTradeMark.'" as name')->limit($limit)->get();
        return $TradeMarks;
    }
}
