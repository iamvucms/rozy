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
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $discounts = Discount::with('RlProduct')->paginate(20);
        return view('Admin.discount',compact('discounts'));
    }
    public function addDiscount(){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        return view('Admin.adddiscount');
    } 
    public function editDiscount($id){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $discount = Discount::find(intval($id));
        if(!$discount) return abort(404);
        return view('Admin.editdiscount',compact('discount'));
    }
    public function postAddDiscount(Request $req){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $req->validate([
            'percent'=>"required|numeric|min:1|max:100",
            'idproduct' =>"required",
            'type'=>"required|numeric|min:1|max:2",
            'total'=>"numeric|min:1",
            'from'=>"required|date_format:Y-m-d\TH:i",
            'to'=>"required|date_format:Y-m-d\TH:i"
        ]);
        $from = date('Y-m-d H:i:s',strtotime($req->from));
        $to = date('Y-m-d H:i:s',strtotime($req->to));
        if(strtotime($from)>= strtotime($to)) return redirect()->back();
        $product = Product::find(intval($req->idproduct));
        if($product===null) return redirect()->back();
        if(array_search(intval($req->type),[1,2])===false) return redirect()->back();
        $discount = new Discount;
        $discount->idproduct = $product->id;
        if($req->type==1){
            if($req->total===null) return redirect()->back();
            if($discount->selled===null && $discount->total===null) $discount->selled = 0;
            $discount->total = $req->total;
        }else{
            $discount->total = null;
            $discount->selled = null;
        }
        $discount->from = $from;
        $discount->to = $to;
        $discount->percent = intval($req->percent);
        $prepercent = (new Discount)->getMaxAvailablerForProduct($product->id);
        $discount->save();
        if($discount->percent > $prepercent){
            $product->sale_price = ceil($product->price - $product->price*$discount->percent/100);
            $product->save();
        }
        return redirect()->route('superDiscount');
    }
    public function postEditDiscount(Request $req,$id){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $req->validate([
            'percent'=>"required|numeric|min:1|max:100",
            'idproduct' =>"required",
            'type'=>"required|numeric|min:1|max:2",
            'total'=>"numeric|min:1",
            'from'=>"required|date_format:Y-m-d\TH:i",
            'to'=>"required|date_format:Y-m-d\TH:i"
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
        $prepercent = (new Discount)->getMaxAvailablerForProduct($product->id);
        $discount->save();
        if($discount->percent > $prepercent){
            $product->sale_price = ceil($product->price - $product->price*$discount->percent/100);
            $product->save();
        }
        return redirect()->route('superDiscount');
    }
    public function postDeleteDiscount(Request $req){
        $user = Auth::user();
        if($user->role_id!=1) return abort(403);
        $ids = $req->ids ?? [];
        foreach($ids as $id){
            $discount = Discount::with('RlProduct')->where('id',intval($id))->first();
            $product = $discount->RlProduct;
            $discount->delete();
            $newPercent = (new Discount)->getMaxAvailablerForProduct($product->id);
            $product->sale_price = ceil($product->price - $product->price*$newPercent/100);
            $product->save();
        }
        return response()->json([], 200, []);
    }
}
