<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function Category(Request $req){
        $cat = Category::where('slug',$req->slug)->first();
        return redirect()->route('filter',['cat'=>$cat->id]);
    }
}
