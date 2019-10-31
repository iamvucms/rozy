<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class DashboardController extends Controller
{
    public function Index(){
        return view('Admin.index');
    }
}
