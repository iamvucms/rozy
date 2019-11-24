<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount;
use Auth;
use App\Product;
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
        $req->validate([
            'percent'=>"required|numeric|min:1|max:100",
            'idproduct' =>"required",
            'type'=>"required|numeric|min:1|max:2",
            'total'=>"numeric|min:1",
            'from'=>"required|date_format:Y-m-d\TH:i:s",
            'to'=>"required|date_format:Y-m-d\TH:i:s"
        ]);
        $discount = Discount::find(intval($id));
        if($discount===null) return redirect()->back();
        $from = date('Y-m-d H:i:s',strtotime($req->from));
        $to = date('Y-m-d H:i:s',strtotime($req->to));
        if(strtotime($from)>= strtotime($to)) return redirect()->back();
        $product = Product::find(intval($req->idproduct));
        if($product===null) return redirect()->back();
        if(array_search(intval($req->type),[1,2])===false) return redirect()->back();
        $discount->idproduct = $product->id;
        if($req->type==1){
            if($discount->selled===null && $discount->total===null) $discount->selled = 0;
            $discount->total = $req->total;
        }else{
            $discount->total = null;
            $discount->selled = null;
        }
        $discount->from = $from;
        $discount->to = $to;
        $discount->percent = intval($req->percent);
        $discount->save();
        return redirect()->route('superDiscount');
    }
    public function postDeleteDiscount(Request $req){

    }
}
