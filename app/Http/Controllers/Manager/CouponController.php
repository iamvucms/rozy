<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\Seller;
use Auth;
class CouponController extends Controller
{
    public function show(){
        $user =Auth::user();
        if($user->role_id==1) $coupons =Coupon::with('Seller')->paginate(20);
        elseif($user->role_id==3) $coupons =Coupon::with('Seller')->where('idsell',$user->Seller()->id)->paginate(20);
        return view('Admin.coupon',compact('coupons'));
    }
    public function editCoupon($id){
        $user = Auth::user();
        $cp = Coupon::where('id',$id)->with('Seller')->first();
        if($cp===null) return abort(404);
        if($user->role_id==3){
            if($cp->Seller->id !== $user->Seller()->id) return abort(403);
            else{
                return view('Admin.editcoupon',compact('cp'));
            }
        }elseif($user->role_id==1){
            $sellers = Seller::get();
            return view('Admin.editcoupon',compact('cp','sellers'));
        }
        else return abort(403);
    }
    public function addCoupon(){
        $user =Auth::user();
        $sellers = Seller::get();
        if($user->role_id==1) return view('Admin.addcoupon',compact('sellers'));
        elseif($user->role_id==3) return view('Admin.addcoupon');
        else return abort(403);
        
    }
    public function postAddCoupon(Request $req){
        $user =Auth::user();
        if($req->idsell===null && $user->role_id==3){
            $req->idsell = $user->Seller()->id;
        }
        $req->validate([
            "name" => "required|min:3",
            "code" => "required|min:7|max:15|unique:coupons,code",
            "count" => "required|numeric|min:1",
            "value" => "required|numeric|min:10000",
            "expired" => "required|date|date_format:Y-m-d",
            "idsell" => "numeric"
        ]);
        if($req->idsell  != 0 && Seller::find(intval($req->idsell))===null) return redirect()->back();
        $expired = date('Y-m-d H:i:s',strtotime($req->expired));
        if(strtotime($req->expired)-time()<=0) return redirect()->back();
        else{
            $cp = new Coupon;
            $cp->name = $req->name;
            $cp->max_using = $req->count;
            $cp->expired = $expired;
            $cp->idsell = intval($req->idsell);
            $cp->value = intval($req->value);
            $cp->code = strtoupper($req->code);
            $cp->save();
        }
        return redirect()->route('superCoupon');
    }
    public function postEditCoupon(Request $req,$id){
        $user =Auth::user();
        if($req->idsell===null && $user->role_id==3){
            $req->idsell = $user->Seller()->id;
        }
        $req->validate([
            "name" => "required|min:3",
            "code" => "required|min:7|max:15",
            "count" => "required|numeric|min:1",
            "value" => "required|numeric|min:10000",
            "expired" => "required|date|date_format:Y-m-d",
            "idsell" => "numeric"
        ]);
        $cp = Coupon::where('id',$id)->first();
        if($cp->code != $req->code && Coupon::where('code',$req->code)->count()>0) return redirect()->back()->withErrors(['code'=>'']);
        if($cp && ($user->role_id==1 || ($user->role_id==3 && $cp->idsell !=0 && $cp->idsell = $user->Seller()->id))){
            $expired = date('Y-m-d H:i:s',strtotime($req->expired));
            if(strtotime($req->expired)-time()<=0) return redirect()->back();
            else{
                $cp->name = $req->name;
                $cp->max_using = $req->count;
                $cp->expired = $expired;
                $cp->idsell = intval($req->idsell);
                $cp->value = intval($req->value);
                $cp->code = strtoupper($req->code);
                $cp->save();
            }
            return redirect()->route('superCoupon');
        }else return abort(403);
    }
    public function postDeleteCoupon(Request $req){
        $user = Auth::user();
        $ids = $req->ids ?? [];
        foreach($ids as $id){
            $cp = Coupon::find(intval($id));
            if($user->role_id==1 || ($user->role_id==3 && $cp->idsell==$user->Seller()->id)){
                $cp->delete();
            }
        }
        return [];
    }
}
