<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function Category(Request $req){
        $products = Category::where('slug',$req->slug)->get();
        return view('detail');
    }
}
