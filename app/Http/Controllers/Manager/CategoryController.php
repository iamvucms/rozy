<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show(){
        return view('Admin.categories');
    }
    public function editCategory(Request $req,$slug){
        $cat = Category::where('slug',$slug)->first();
        if($cat===null) return abort(404);
        return view('Admin.editcat',compact("cat"));
    }
    public function postEditCategory(Request $req,$slug){
        $cat = Category::where('slug',$slug)->first();
        if($cat===null) return abort(404);
        $data = $req->validate([
            'name'=>'required|min:5',
            'order'=>'required|numeric',
            'slug'=>'required|min:5',
            'img'=>'image'
        ]);
        $cat->name = $data['name'];
        $cat->order = $data['order'];
        $cat->slug = $data['slug'];
        $cat->icon = $req->icon;
        $cat->seo_description = $req->seo_description ?? '';
        $cat->description = $req->description ?? '';
        $cat->seo_keys = $req->seo_keys ?? '';
        if($req->hasFile('img')){ 
            unlink(public_path().$cat->img);
            $avt=$data['img'];
            $filename = $avt->getClientOriginalName();
            if(file_exists(public_path().'/upload/categories/'.$filename)){
                $filename = rand(0,9999999).$avt->getClientOriginalName();
            }
            $avt->move('upload/categories/',$filename);
            $cat->img = '/upload/categories/'.$filename;
        }
        $cat->save();
        return redirect(route('superCategory'));
    }
}
