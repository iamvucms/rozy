<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function Login(){
        return view('Admin.login');
    }
    public function postLogin(Request $req){
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            return redirect(url()->route('dashboard'));
        }
        return redirect(url()->route('superLogin'));
    }
}
