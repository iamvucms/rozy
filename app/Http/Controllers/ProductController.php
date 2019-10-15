<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Cookie;
class ProductController extends Controller
{
    public function Product(Request $req){
        $product = Product::where('slug',$req->slug)->first();
        $viewedList = Cookie::get('viewedList');
        if($viewedList===null){
            Cookie::queue('viewedList',json_encode([]),9999999999); 
        }
        $viewedList = json_decode(Cookie::get('viewedList'),true) ?? [];
        $viewedProduct = ['avt'=>$product->Avatar()->src ?? '','slug'=>$product->slug];
        $exist = false;
        foreach($viewedList as $viewed){
            if($viewed['slug']==$viewedProduct['slug']){
                $exist = true;
                break;
            }
        }
        if(!$exist) $viewedList[] = $viewedProduct;
        if(count($viewedList)>10){
            array_splice($viewedList, 0, count($viewedList)-10);
        }
        Cookie::queue('viewedList',json_encode($viewedList),9999999999);
        if($product==null) return abort(404);
        return view("detail",compact("product"));
    }
}
