<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Alias;
use App\Discount;
class HomeController extends Controller
{
    public function Index(Request $req){
        $alias = Alias::class;
        $products = Product::get();
        $categories = Category::get();
        $flashsales = new Discount();
        $flashsales =$flashsales->Flashsales();
        // dd($products[0]->ExistDiscount()->get()[0]->percent);
        return view('index',compact('products','categories','alias','flashsales'));
    }
}
