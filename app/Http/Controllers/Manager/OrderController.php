<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function getMoneyEachDay(Request $req){
        $order = new Order;
        $validatedData = $req->validate([
            'month'=>'digits_between:1,12'
        ]);
        $dataMoney = $order->getMoneyEachDay($validatedData['month']);
        return $dataMoney;
    }
    public function show(){
        dd('ok');
    }
    public function Order(Request $req,$slug){
        dd($slug);
    }
}
