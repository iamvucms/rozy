<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\History;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Index(){
        if(Auth::user()->role_id==1) $lastActions = History::orderBy('id','DESC')->limit(5)->get();
        else $lastActions = Auth::user()->History()->orderBy('id','DESC')->limit(5)->get();
        $lastCustomers = Customer::orderBy('id','DESC')->limit(4)->get();
        return view('Admin.index',compact('lastCustomers','lastActions'));
    }
}
