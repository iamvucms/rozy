<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
class ProductController extends Controller
{
    public function show(){
        $user = Auth::user();
        if($user->role_id==1){
            $products = Product::paginate(20);
        }elseif($user->role_id==3){
            $products = Product::where('idsell',$user->Seller()->id)->paginate(20);
        }
        return view('Admin.product',compact('products'));
    }
    public function getProduct($id){
        $product = Product::find($id);
        if($product){

        }else abort(404);
    }
    public function addProduct(){
        return view('Admin.addproduct');
    }
}
