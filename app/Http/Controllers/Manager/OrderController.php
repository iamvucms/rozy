<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Auth;
class OrderController extends Controller
{
    public function getMoneyEachDay(Request $req){
        $order = new Order;
        $validatedData = $req->validate([
            'month'=>'digits_between:1,12'
        ]);
        $dataMoney = $order->getMoneyEachDay($validatedData['month']);
        return $dataMoney;
    }
    public function show(){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $orders = Order::with('OrderDetails')->with('Shipper')->with('Seller')->with('RlCustomer')->paginate(20);
        else if($role==3) $orders = Order::where('idsell',$user->Seller()->id)->with('OrderDetails')->with('Shipper')->with('Seller')->with('RlCustomer')->paginate(20);
        return view('Admin.order',compact('orders'));
    }
    public function editOrder(Request $req){
        $ids = $req->ids??[];
        $user = Auth::user();
        $role_id = $user->role_id;
        foreach($ids as $id){
            $order = Order::find(intval($id));
            if(($role_id==1 || $user->Seller()->id == $order->idsell) && $order->status==1){
                $order->status = 2;
                $order->save();
            }
        }
        return response()->json(['success'=>true], 200, []);
    }
    public function postEditOrder(Request $req){

    }
    public function postDeleteOrder(Request $req){
        $ids = $req->ids??[];
        $user = Auth::user();
        $role_id = $user->role_id;
        foreach($ids as $id){
            $order = Order::find(intval($id));
            if($role_id==1) {
                $order->OrderDetails()->delete();
                $order->delete();
            }
        }
        return response()->json(['success'=>true], 200, []);
    }
}
