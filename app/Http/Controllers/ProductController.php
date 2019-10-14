<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function Product(Request $req){
        $product = Product::where('slug',$req->slug)->first();
        if($product==null) return abort(404);
        return view("detail",compact("product"));
    }
}
