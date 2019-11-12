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
    public function addCategory(){
        return view('Admin.addcat');
    }
    public function postAddCategory(Request $req){
        $cat = new Category;
        $data = $req->validate([
            'name'=>'required|min:5',
            'order'=>'required|numeric',
            'slug'=>'required|min:5',
            'catAvt'=>'image'
        ]);
        $cat->name = $data['name'];
        $cat->order = $data['order'];
        $cat->slug = $data['slug'];
        $cat->icon = $req->icon;
        $cat->seo_description = $req->seo_description ?? '';
        $cat->description = $req->description ?? '';
        $cat->seo_keys = $req->seo_keys ?? '';
        if($req->hasFile('catAvt')){ 
            if($cat->img!='' && file_exists(public_path().$cat->img)) unlink(public_path().$cat->img);
            $avt = $req->file('catAvt');
            $filename = $avt->getClientOriginalName();
            if(file_exists(public_path().'/upload/categories/'.$filename)){
                $filename = rand(0,9999999).$avt->getClientOriginalName();
            }
            move_uploaded_file($avt->getPathName(),public_path().'/upload/categories/'.$filename);
            $cat->img = '/upload/categories/'.$filename;
        }
        $cat->save();
        return redirect(route('superCategory'));
    }
    public function postDeleteCategory(Request $req){
        foreach($req->ids as $id){
            $cat = Category::find($id);
            if($cat){
                $cat->Products()->delete();
                $cat->delete();
            }
        }
        return response()->json(['success'=>true], 200, []);
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
            if(file_exists(public_path().$cat->img)){
                unlink(public_path().$cat->img);
            }
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
