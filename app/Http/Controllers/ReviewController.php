<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Review;
use App\Image;
use App\Product;
class ReviewController extends Controller
{
    public function increPoint(Request $req){
        $rv = Review::find($req->id);
        if($rv){
            $sessIncrement = Session::get('point_increment_ids') ??[];
            if(array_search($rv->id,$sessIncrement)===false){
                $rv->point = $rv->point+1;
                $rv->save();
                $sessIncrement[] = $rv->id;
                Session::put('point_increment_ids',$sessIncrement);
                return response()->json(['success'=>true], 200, []);
            }else{
                return response()->json(['success'=>false], 200, []);
            }
            
        }else{
            return response()->json(['success'=>false], 200, []);
        }
    }
    public function create(Request $req,$idproduct){
        $req->validate([
            'content'=>'min:30|required',
            'rvStar'=> 'digits_between:1,5|required',
            'rvImages'=>'max:5'
        ]);
        $user = Auth::user();
        if(!$user) return redirect()->back();
        $product = Product::find($idproduct);
        $check = Review::where('idpro',$product->id)->where('idcus',$user->getInfo()->id)->count();
        if($product && $check===0){
            $review = new Review;
            $review->idpro = $product->id;
            $review->message = $req->content;
            $review->idcus = $user->getInfo()->id;
            $review->star = $req->rvStar;
            $review->save();
            foreach($req->rvImages as $rvImg){
                $randName = rand(10000000,999999999).$rvImg->getClientOriginalName();
                $rvImg->move('upload/reviews/', $randName);
                $img = new Image;
                $img->id_review = $review->id;
                $img->src = 'upload/reviews/'.$randName;
                $img->save();
            }
        }
        return redirect()->back();
    }
}
