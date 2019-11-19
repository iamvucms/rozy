<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seller;
use App\City;
use App\District;
use App\Commune;
use App\Image;
class SellerController extends Controller
{
    public function __construct(){
    }
    public function show(){
        $user = Auth::user();
        $sellers = Seller::paginate(20);
        if($user->role_id != 1) abort(403); 
        return view('Admin.supplier',compact('sellers'));
    }
    public function editSeller($id){
        
        $seller = Seller::find($id);
        if($seller===null) return abort(404);
        $city = City::get();
        $district = District::where('city_id',$seller->city_id)->get();
        $commune = Commune::where('district_id',$seller->district_id)->get();
        return view('Admin.editsup',compact('seller','district','city','commune'));
    }
    public function postEditSeller(Request $req,$id){
        $seller = Seller::find($id);
        if($seller===null) return abort(404);
        $req->validate([
            'name'=>'required|min:3',
            'short_description'=>'required|min:3|max:50',
            'description'=>'required',
            'name'=>'required|min:3',
            'displayEmail' =>'required|email:rfc,dns',
            'displayPhone' =>'required|digits:10',
            'city'=>'required|numeric',
            'district'=>'required|numeric',
            'commune'=>'required|numeric',
            'street' =>'required|min:3',
            'cover'=>'image',
            'avatar'=>'image'
        ]);
        $city = City::find(intval($req->city));
        $district = District::find(intval($req->district));
        $commune = Commune::find(intval($req->commune));
        if($city===null ||$district === null|| $commune === null) return redirect()->back()->withErrors('address','1');
        if($req->hasFile('avatar')){
            $avatar = $seller->Avatar()->first();
            if($avatar===null){
                $avatar = new Image;
                $avatar->id_avt_seller = $seller->id;
            }
            $avt = $req->avatar;
            if($avatar->src!==null &file_exists(public_path().$avatar->src)){
                unlink(public_path().$avatar->src);
            }
            $filename = $avt->getClientOriginalName();
            if(file_exists(public_path().'/upload/sellers/'.$filename)){
                $filename = rand(0,9999999).$avt->getClientOriginalName();
            }
            $avt->move('upload/sellers/',$filename);
            $avatar->src = '/upload/sellers/'.$filename;
            $avatar->save();
        }
        if($req->hasFile('cover')){
            $cover = $seller->Cover()->first();
            if($cover===null){
                $cover = new Image;
                $cover->id_cover_seller = $seller->id;
            }
            $cv = $req->cover;
            if($cover->src!==null & file_exists(public_path().$cover->src)){
                unlink(public_path().$cover->src);
            }
            $filename = $cv->getClientOriginalName();
            if(file_exists(public_path().'/upload/sellers/'.$filename)){
                $filename = rand(0,9999999).$cv->getClientOriginalName();
            }
            $cv->move('upload/sellers/',$filename);
            $cover->src = '/upload/sellers/'.$filename;
            $cover->save();
        }
        $seller->district_id = intval($req->district);
        $seller->city_id = intval($req->city);
        $seller->commune_id = intval($req->commune);
        $seller->street = $req->street;
        $seller->short_description = $req->short_description;
        $seller->description = $req->description;
        $seller->phone = $req->displayPhone;
        $seller->email = $req->displayEmail;
        $seller->save();
        return redirect()->route('superSeller');
    }
    public function postDeleteSeller(Request $req){
        foreach($req->ids as $id){
            $seller = Seller::find(intval($id));
            if($seller){
                $seller->Products()->delete();
                $seller->Cover()->delete();
                $seller->Avatar()->delete();
                $seller->User()->delete();
                $seller->delete();
            }
        }
        return response()->json(['success'=>true], 200, []);

    }
}
