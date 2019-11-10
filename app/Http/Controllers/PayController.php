<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cart;
class PayController extends Controller
{
    public function show(Request $req){
        if(count((new Cart)->getCart())==0) return redirect(url()->route('home'));
        if(Auth::user() && intval($req->step)<=1) 
            return redirect(url()->route('payment',['step'=>2]));
        return view('payment');
    }
}
