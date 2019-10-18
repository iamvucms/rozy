<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
class FilterController extends Controller
{
    public function Search(Request $req){
        $product  = new Product;
        $filter = $req->toArray();
        $products = null;
        $products = $product->ProductFilter(
            $req->cat,
            $req->keyword,
            $req->from,
            $req->to,
            $req->address,
            $req->star,
            $req->orderBy)->appends($req->except('page'));
        $countAfterFilter = $product->getCountAfterFilter($req->cat,
            $req->keyword,
            $req->from,
            $req->to,
            $req->address,
            $req->star);
        return view('filter',compact('products','filter','countAfterFilter'));
    }
}
