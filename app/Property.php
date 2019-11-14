<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Property extends Model
{
    protected $table = "properties";
    public $timestamps = false;
    public static function getPropKey($uuid){
        return DB::table('alias')->select('alias')->where('prop',$uuid)->first()->alias ?? '';
    }
}
