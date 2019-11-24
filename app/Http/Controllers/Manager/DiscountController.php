<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount;
use Auth;
class DiscountController extends Controller
{
    public function show(){
        $discounts = Discount::with('RlProduct')->paginate(20);
        return view('Admin.discount',compact('discounts'));
    }
    public function addDiscount(){

    } 
    public function editDiscount($id){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $discount = Discount::find(intval($id));
        if(!$discount) return abort(404);
        return view('Admin.editdiscount',compact('discount'));
    }
    public function postAddDiscount(Request $req){

    }
    public function postEditDiscount(Request $req,$id){

    }
    public function postDeleteDiscount(Request $req){

    }
}
