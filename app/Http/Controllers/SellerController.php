<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Seller;

class SellerController extends Controller
{
    public function Shop($slug){
        $seller = Seller::where('slug',$slug)->first();
        return view('shop',compact("seller"));
    }
}
