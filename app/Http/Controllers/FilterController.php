<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class FilterController extends Controller
{
    public function Search(Request $req){
        $product  = new Product;
        $filter = $req->toArray();
        $products = $product
        ->ProductFilter(
            $req->keyword,
            $req->from,
            $req->to,
            $req->address,
            $req->star,
            $req->orderBy);
        return view('filter',compact('products','filter'));
    }
}
