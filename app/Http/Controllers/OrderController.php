<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function OrderStatus(Request $req,$id){
        $orderData = $req->validate([
            'status' => 'required|min:1|max:5',
        ]);
        $order = Order::where('id',$id)->first();
        if($order->count()==0) return response()->json(['success'=>false], 200, []);
        if(Auth::user()->getInfo()->id != $order->idcus) return response()->json(['success'=>false], 200, []);
        $order->status = $orderData['status'];
        $order->save();
        return response()->json(['success'=>true], 200, []);
    }
}
