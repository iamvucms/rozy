<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function Seller(Request $req){
        return $req->slug;
    }
}
