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
}
