<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
class CartController extends Controller
{
    public function Cart(Request $req){
        $cart = new Cart();
        return view('cart',compact("cart"));
    }
    public function addCart(Request $req){
        $validatedData = $req->validate([
            'id' => 'required|integer',
            'quantity' =>'required|integer'
        ]); 
        $cart = new Cart();
        return response()->json(['success'=>$cart->addItem($req->id,$req->quantity),
            'dataCart' =>$cart->getCart()
        ], 200,[]);
    }
    public function editCart(Request $req){
        $cart = new Cart();
        foreach($req->quantity as $id=> $quantity){
            $cart->editItem($id,$quantity);
        }
        return redirect(url('/cart'));
    }
    public function deleteCart(Request $req){
        $cart = new Cart();
        $req->validate([
            'id' => 'required|integer',
        ]); 
        return response()->json(['success'=>$cart->delItem($req->id),'dataCart' => $cart->getCart()]);
    }
}
