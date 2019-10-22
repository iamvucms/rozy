<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Customer;
use App\Image;
use App\Order;
use App\Notification;

class UserController extends Controller
{
    public function Profile(Request $req){
        $user = Auth::user();
        $branch = "account";
        return view('account',compact("user","branch"));
    }
    public function postProfile(Request $req){
        $validatedData = $req->validate([
            'name' => 'required|min:3',
            'phone'=>'required|digits:10',
            'address'=>'required',
            'gender'=>'required|digits:1',
            'pass'=>'',
            'cpass'=>'same:pass',
            'avatar' =>'image'
        ]);
        $user = Auth::user();
        if($validatedData['pass'] !='' && $validatedData['pass'] == $validatedData['cpass']){
            $user->password = bcrypt($validatedData['pass']);
        }
        $user->save();
        $customer = Customer::where('user_id',Auth::user()->id)->first();
        $customer->name = $validatedData['name'];
        $customer->phone = $validatedData['phone'];
        $customer->address = $validatedData['address'];
        $customer->gender = $validatedData['gender'];
        $customer->save();
        if($req->hasFile('avatar')){ 
            $avt=$validatedData['avatar'];
            $avt->move('upload',$avt->getClientOriginalName());
            Image::updateOrCreate(['id_avt_user'=> Auth::user()->id],['src'=>'/upload/'.$avt->getClientOriginalName()]);
        }
        return redirect()->back();
    }
    public function Order(){
        $user = Auth::user();
        $orders = $user->getOrders();
        $branch = "order";
        return view('account',compact("user","branch","orders"));
    }
    public function Notify(){
        $user = Auth::user();
        $notifications = Notification::where([['to','=',$user->id],['is_hidden','=','0']])->orWhere('is_all',1)->get();
        $branch = "notify";
        return view('account',compact("user","branch",'notifications'));
    }
    public function postNotify(Request $req){

    }
}
