<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function show(Request $req){
        if(Auth::user() && intval($req->step)<=1) 
            return redirect(url()->route('payment',['step'=>2]));
        return view('payment');
    }
}
