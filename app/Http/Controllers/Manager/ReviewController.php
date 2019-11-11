<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Review;
class ReviewController extends Controller
{
    public function increPoint(Request $req){
        $rv = Review::find($req->id);
        if($rv){
            $sessIncrement = Session::get('point_increment_ids') ??[];
            if(!array_search($rv->idpro,$sessIncrement)){
                $rv->increment('point');
                $sessIncrement[] = $rv->idpro;
                Session::queue('point_increment_ids',$sessIncrement);
                return response()->json(['success'=>true], 200, []);
            }else{
                return response()->json(['success'=>false], 200, []);
            }
            
        }else{
            return response()->json(['success'=>false], 200, []);
        }
    }
}
