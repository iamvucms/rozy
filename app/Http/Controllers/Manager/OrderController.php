<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Auth;
use App\Product;
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
        else if($role_id==3) $orders = Order::where('idsell',$user->Seller()->id)->with('OrderDetails')->with('Shipper')->with('Seller')->with('RlCustomer')->paginate(20);
        return view('Admin.order',compact('orders'));
    }
    public function postDeleteOrderDetail(Request $req){
        $user = Auth::user();
        $role_id = $user->role_id;
        $order = Order::find(intval($req->idorder));
        $product = Product::find(intval($req->idproduct));
        if($order===null || $product===null) return response()->json(['success'=>false], 200, []);
        if($order->status!=1) return response()->json(['success'=>false], 200, []);
        if(($role_id==1 || $user->Seller()->id == $order->idsell) && $order->status==1){
            $order->OrderDetails()->where('idpro',$product->id)->delete();
            if($order->OrderDetails()->count()==0){
                $order->delete();
                return response()->json(['success'=>true,'isF5' => true], 200, []);
            }
        }
        
        return response()->json(['success'=>true,'isF5' => false], 200, []);
    }
    public function completedOrder(Request $req){
        $ids = $req->ids??[];
        $user = Auth::user();
        $role_id = $user->role_id;
        foreach($ids as $id){
            $order = Order::find(intval($id));
            if(($role_id==1 || $user->Seller()->id == $order->idsell) && $order->status<4){
                $order->status = 4;
                $order->save();
            }
        }
        return response()->json(['success'=>true], 200, []);
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
    public function getOrderDetail(Request $req){
        $user = Auth::user();
        $role_id = $user->role_id;
        $order = Order::find(intval($req->id));
        if($role_id==1 && $order) $orderDetails = (new Order)->where('id',$req->id)->with('OrderDetails')->with('Shipper')->get()->toArray();
        elseif($role_id==3 && $order && $order->idsell == $user->Seller()->id){
            $orderDetails = (new Order)->where('id',$req->id)->with('OrderDetails')->with('Shipper')->get()->toArray();
        }else{
            return response()->json(['success'=>false], 200, []);
        }
        $temp = $orderDetails[0]["shipper"]["name"];
        $orderDetails[0]["shipper"] = [];
        $orderDetails[0]["shipper"]["name"] =$temp;
        return response()->json(['success'=>true,'data'=>$orderDetails], 200, []);
    }
    public function postEditOrder(Request $req){
    }
    public function getOrder($id){
        $user = Auth::user();
        $role_id = $user->role_id;
        if($role_id==1) $orders = Order::where('id',intval($id))->with('OrderDetails')->with('Shipper')->with('Seller')->with('RlCustomer')->paginate(20);
        else if($role_id==3) $orders = Order::where('id',intval($id))->where('idsell',$user->Seller()->id)->with('OrderDetails')->with('Shipper')->with('Seller')->with('RlCustomer')->paginate(20);
        if(count($orders)==0) return abort(403);
        return view('Admin.order',compact('orders'));
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
