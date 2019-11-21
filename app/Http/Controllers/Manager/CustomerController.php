<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Image;
use Auth;
class CustomerController extends Controller
{
    public function show(Request $req){
        $customers = Customer::with('User')->with('Image')->with('Reviews')->with('Orders')->paginate(20);
        return view('Admin.customer',compact("customers"));
    }
    public function editCustomer($id){
        $customer =Customer::with('Image')->find(intval($id));
        return view('Admin.editcustomer',compact('customer'));
    }
    public function postEditCustomer(Request $req,$id){
        $req->validate([
            'name' => 'required|min:2',
            "address" => "required",
            "group_type" => "required|numeric",
            "gender" =>"required|numeric",
            "phone" => "required|digits:10",
            "notification" => "required|numeric|digits:1",
            "avatar" =>'image',
        ]);
        $customer =Customer::find(intval($id));
        if(!$customer) return redirect()->back();
        if(Auth::user()->role_id!=1 && Auth::user()->id!=$customer->user_id) return abort(403);
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($req->address),$api);
        $data = json_decode(file_get_contents($buyerApi),true)['results'];
        if(array_search(intval($req->gender),[1,2])===false) return redirect()->back();
        if(array_search(intval($req->notification),[0,1])===false) return redirect()->back();
        if(array_search(intval($req->group_type),[0,1,2,3,4])===false) return redirect()->back();
        if(count($data)==0){
            return redirect()->back();
        }else{
            $customer->name = $req->name;
            $customer->gender = intval($req->gender);
            $customer->address = $req->address;
            $customer->group_type = intval($req->group_type);
            $customer->phone = $req->phone;
            $customer->notification = intval($req->notification);
            $customer->save();
            if($req->hasFile('avatar')){
                $avatar = $customer->Image()->first();
                if($avatar){
                    if(file_exists(public_path().$avatar->src)){
                        unlink(public_path().$avatar->src);
                    }
                }else $avatar = new Image;
                $avt = $req->avatar;
                $filename = $avt->getClientOriginalName();
                if(file_exists(public_path().'/upload/customers/'.$filename)){
                    $filename = rand(0,9999999).$avt->getClientOriginalName();
                }
                $avt->move('upload/customers/',$filename);
                $avatar->src = '/upload/customers/'.$filename;
                $avatar->id_avt_user = $customer->user_id;
                $avatar->save();
            }
            return redirect()->route('superCustomer');
        }
    }
    public function addCustomer(){
        return view('Admin.addcustomer');
    }
    public function postAddCustomer(Request $req){
        $req->validate([
            'name' => 'required|min:2',
            "address" => "required",
            "group_type" => "required|numeric",
            "gender" =>"required|numeric",
            "phone" => "required|digits:10",
            "notification" => "required|numeric|digits:1",
            "email" => "email:rfc,dns|required|unique:users,email",
            "password" => "required|min:5",
            "cpassword" => "required|same:password",
            "avatar" =>'required|image',
        ]);
        $api = 'https://maps.google.com/maps/api/geocode/json?address=YOUR_PLACE&key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4';
        $buyerApi = str_replace('YOUR_PLACE',urlencode($req->address),$api);
        $data = json_decode(file_get_contents($buyerApi),true)['results'];
        if(array_search(intval($req->gender),[1,2])===false) return redirect()->back();
        if(array_search(intval($req->notification),[0,1])===false) return redirect()->back();
        if(array_search(intval($req->group_type),[0,1,2,3,4])===false) return redirect()->back();
        if(count($data)==0){
            return redirect()->back();
        }else{
            $user = new User;
            $user->email = $req->email;
            $user->password = bcrypt($req->password);
            $user->last_login = date('Y-m-d H:i:s');
            $user->role_id=4;
            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->name = $req->name;
            $customer->gender = intval($req->gender);
            $customer->address = $req->address;
            $customer->group_type = intval($req->group_type);
            $customer->phone = $req->phone;
            $customer->notification = intval($req->notification);
            $customer->save();
            if($req->hasFile('avatar')){
                $avatar = new Image;
                $avt = $req->avatar;
                $filename = $avt->getClientOriginalName();
                if(file_exists(public_path().'/upload/customers/'.$filename)){
                    $filename = rand(0,9999999).$avt->getClientOriginalName();
                }
                $avt->move('upload/customers/',$filename);
                $avatar->src = '/upload/customers/'.$filename;
                $avatar->id_avt_user = $customer->user_id;
                $avatar->save();
            }
            return redirect()->route('superCustomer');
        }
    }
    public function postDeleteCustomer(Request $req){
        if(Auth::user()->role_id!=1) return redirect()->back();
        foreach($req->ids as $id){
            $customer = Customer::find(intval($id));
            $customer->User()->delete();
            $customer->Image()->delete();
            $customer->Orders()->delete();
            $customer->Reviews()->delete();
            $customer->delete();
        }
        return redirect()->route('superCustomer');
    }
    public function getBannerCustomer(){
        $customers = Customer::where('group_type','4')->with('User')->with('Image')->with('Reviews')->with('Orders')->paginate(20);
        return view('Admin.bannercustomer',compact('customers'));
    }
    public function postUnbanCustomer(Request $req){
        $ids = $req->ids ?? [];
        foreach($ids as $id){
            $customer = Customer::find(intval($id));
            if($customer){
                $customer->group_type=0;
                $customer->save();
            }
        }
        return response()->json(['success'=>true], 200, []);
    }
}
