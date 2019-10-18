<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    protected $redirect = '/';
    public function Logout(){
        Auth::logout();
        return redirect($this->redirect);
    }
}
