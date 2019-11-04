<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\History;
use App\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Index(){
        
        if(Auth::user()->role_id==1) $lastActions = History::orderBy('id','DESC')->limit(5)->get();
        else $lastActions = Auth::user()->History()->orderBy('id','DESC')->limit(5)->get();
        if(Auth::user()->role_id==1) $lastCustomers = Customer::orderBy('id','DESC')->limit(4)->get();
        else $lastCustomers = (new Order)->getLastCustomerOfSeller(Auth::user()->Seller()->id);
        if(Auth::user()->role_id==1) $lastOrders = Order::orderBy('id','DESC')->limit(8)->get();
        else $lastOrders = Order::where('idsell',Auth::user()->Seller()->id)->orderBy('id','DESC')->limit(8)->get();
        return view('Admin.index',compact('lastCustomers','lastActions','lastOrders'));
    }
}
