<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Seller;
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
    public function show(){
        $reviews = [];
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1){
            $rvObj = new Review;
            $countToDay = $rvObj->getCountReviewToday();
            $avg = $rvObj->getAvgReview();
            $avgPoint = $rvObj->getAvgPointReview();
            $coundBad = $rvObj->getCountBadReview();
            $countGood = $rvObj->getCountGoodReview();
            $reviews =Review::get()->paginate(20);
        }elseif($role_id==3){
            $countToDay = $user->Seller()->getCountReviewToday();
            $avg = $user->Seller()->getAvgReview();
            $avgPoint = $user->Seller()->getAvgPointReview();
            $coundBad = $user->Seller()->getCountBadReview();
            $countGood = $user->Seller()->getCountGoodReview();
            $reviews = $user->Seller()->getReviews()->paginate(20);
        }
        return view('Admin.vote',compact('reviews','countToDay','avg','avgPoint','countGood','coundBad'));
    }
}
