<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\Image;
use App\Alias;
use App\Property;
class ProductController extends Controller
{
    public function show(){
        $user = Auth::user();
        if($user->role_id==1){
            $products = Product::orderBy('id','desc')->paginate(20);
        }elseif($user->role_id==3){
            $products = Product::where('idsell',$user->Seller()->id)->orderBy('id','desc')->paginate(20);
        }else return abort(403);
        return view('Admin.product',compact('products'));
    }
    public function postDeleteProduct(Request $req){
        foreach($req->ids ?? [] as $id){
            $product = Product::find($id);
            if($product){
                $product->Image()->delete();
                $product->Property()->delete();
                $product->ImgAvt()->delete();
                $product->Slide()->delete();
                $product->Discount()->delete();
                $product->delete();
            }
        }
        return response()->json(['success'=>true], 200, []);
    }
    public function getProduct($id){
        $product = Product::find($id);
        if($product){
            return view('Admin.editproduct',compact("product"));
        }else abort(404);
    }
    public function addProduct(){
        return view('Admin.addproduct');
    }
    public function postEditProduct(Request $req,$slug){
        $product = Product::where('slug',$slug)->first();
        if($product){
            
        $req->validate([
            "name" => "required|min:5",
            "metaTitle" => "required|min:5",
            "idcat" => "required|numeric",
            "status" => "required|numeric",
            "metaDescription" => "required",
            "metaKeyword" => "required",
            "description" => "required",
            "model" => "required",
            "brand" => "required|min:2",
            "sku" => "required|min:5",
            "quantity" => "required|numeric",
            "madeIn" => "required"
        ]);
        if(count($req->groupImg ?? [])!=count($req->groupImg ?? []) 
        || count($req->propertyName)!=count($req->propertyValue) ) return redirect()->back()->withInput();
        $user = Auth::user();
        if(($user->Seller()->id ?? 0) !=$product->Seller()->id && $user->role_id !=1) return abort(403);
        $product->name = $req->name;
        $cat = Category::find(intval($req->idcat));
        if($cat) $product->idcat = $cat->id;
        else return redirect()->back()->withErrors(['idcat'=>'Danh mục không hợp lệ'])->withInput();
        if(!array_search(intval($req->status),[1,2,3])){
            $product->status = $req->status;
        }else return redirect()->back()->withErrors(['status'=>'Trạng thái không hợp lệ'])->withInput();
        $product->metaDescription = $req->metaDescription;
        $product->metaKeyword = $req->metaKeyword;
        $product->metaTitle = $req->metaTitle;
        $product->description = $req->description;
        $product->quantity = $req->quantity;
        $product->price = $req->cost;
        $product->sale_price = $req->cost;
        $slug = $this->nameToSlug($req->name);
        $product->slug = $slug;
        if($user->role_id==1) $product->idsell = $req->idsell;
        else $product->idsell = $user->Seller()->id;
        $product->save();
        $product->slug = $product->slug.'-'.$product->id;
        $product->save();
        //Add properties
        $keyName = $req->propertyName ?? [];
        $jsonData = [];
        $jsonData['sku'] = $req->sku;
        $jsonData['model'] = $req->model;
        $jsonData['thuonghieu'] = $req->brand;
        $jsonData['madein'] = $req->madeIn;
        foreach($keyName as $key=>$value){
            $keyName[$key]= $this->viToEng($keyName[$key]);
            $jsonData[$keyName[$key]]=$req->propertyValue[$key];
            $alias = Alias::where('prop',$keyName[$key])->where('idcat',intval($req->idcat))->count();
            if($alias==0){
                $newAlias = new Alias;
                $newAlias->prop = $keyName[$key];
                $newAlias->alias = $req->propertyName[$key];
                $newAlias->idcat = intval($req->idcat);
                $newAlias->save();
            }
        }
        $property = Property::find($product->id);
        if(!$property) $property = new Property;
        $property->json = json_encode($jsonData,JSON_UNESCAPED_UNICODE);
        $property->id = $product->id;
        $property->save();
        $isDeleteAvatar = false;
        if(count($req->willDeleteImg ?? [])>0){
            foreach($req->willDeleteImg as $key => $value){
                $image = Image::find($value);
                if($image && ($image->id_avt_product==$product->id 
                || $image->id_product==$product->id || $image->id_slide_product==$product->id)){
                    if($image->id_avt_product == $product->id) $isDeleteAvatar = true;
                    $image->delete();
                }
            }
        }
        $isDeleteAvatar = $isDeleteAvatar || Image::where('id_avt_product',$product->id)->count()==0;
        foreach($req->groupImg ?? [] as $key =>$value){
            switch ($value) {
                case 1:
                    if(!$isDeleteAvatar) break;
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_avt_product = $product->id;
                    try{
                        $Image->save();
                    } catch(\Illuminate\Database\QueryException $ex){ 
                        return redirect()->back();
                        // Note any method of class PDOException can be called on $ex.
                    }
                  
                    break;
                case 2:
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_product = $product->id;
                    $Image->save();
                    break;
                case 3:
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_slide_product = $product->id;
                    $Image->save();
                    break;
                default:
                    break;
            }
        }
        return redirect()->back();
        }else return abort(404);
    }
    public function postAddProduct(Request $req){
        
        $req->validate([
            "name" => "required|min:5",
            "metaTitle" => "required|min:5",
            "idcat" => "required|numeric",
            "status" => "required|numeric",
            "metaDescription" => "required",
            "metaKeyword" => "required",
            "description" => "required",
            "idsell" => "numeric",
            "model" => "required",
            "brand" => "required|min:2",
            "sku" => "required|min:5",
            "quantity" => "required|numeric",
            "madeIn" => "required"
        ]);
        if(count($req->groupImg)!=count($req->ImgProducts) 
        || count($req->propertyName)!=count($req->propertyValue) ) return redirect()->back()->withInput();
        $user = Auth::user();
        $product = new Product;
        $product->name = $req->name;
        $cat = Category::find(intval($req->idcat));
        if($cat) $product->idcat = $cat->id;
        else return redirect()->back()->withErrors(['idcat'=>'Danh mục không hợp lệ'])->withInput();
        if(!array_search(intval($req->status),[1,2,3])){
            $product->status = $req->status;
        }else return redirect()->back()->withErrors(['status'=>'Trạng thái không hợp lệ'])->withInput();
        $product->metaDescription = $req->metaDescription;
        $product->metaKeyword = $req->metaKeyword;
        $product->metaTitle = $req->metaTitle;
        $product->description = $req->description;
        $product->quantity = $req->quantity;
        $product->price = $req->cost;
        $product->sale_price = $req->cost;
        $slug = $this->nameToSlug($req->name);
        $product->slug = $slug;
        if($user->role_id==1) $product->idsell = $req->idsell;
        else $product->idsell = $user->Seller()->id;
        $product->save();
        $product->slug = $product->slug.'-'.$product->id;
        $product->save();
        //Add properties
        $keyName = $req->propertyName ?? [];
        $jsonData = [];
        $jsonData['sku'] = $req->sku;
        $jsonData['model'] = $req->model;
        $jsonData['thuonghieu'] = $req->brand;
        $jsonData['madein'] = $req->madeIn;
        foreach($keyName as $key=>$value){
            $keyName[$key]= $this->viToEng($keyName[$key]);
            $jsonData[$keyName[$key]]=$req->propertyValue[$key];
            $alias = Alias::where('prop',$keyName[$key])->where('idcat',intval($req->idcat))->count();
            if($alias==0){
                $newAlias = new Alias;
                $newAlias->prop = $keyName[$key];
                $newAlias->alias = $req->propertyName[$key];
                $newAlias->idcat = intval($req->idcat);
                $newAlias->save();
            }
        }
        $property = new Property;
        $property->json = json_encode($jsonData,JSON_UNESCAPED_UNICODE);
        $property->id = $product->id;
        $property->save();
        foreach($req->groupImg as $key =>$value){
            switch ($value) {
                case 1:
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_avt_product = $product->id;
                    try{
                        $Image->save();
                    } catch(\Illuminate\Database\QueryException $ex){ 
                        return redirect()->back();
                        // Note any method of class PDOException can be called on $ex.
                    }
                    break;
                case 2:
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_product = $product->id;
                    $Image->save();
                    break;
                case 3:
                    $Img = $req->ImgProducts[$key];
                    $filename = $Img->getClientOriginalName();
                    if(file_exists(public_path().'/upload/products/'.$filename)){
                        $filename = rand(0,9999999).$Img->getClientOriginalName();
                    }
                    $Img->move('upload/products/',$filename);
                    $Image = new Image;
                    $Image->src = '/upload/products/'.$filename;
                    $Image->id_slide_product = $product->id;
                    $Image->save();
                    break;
                default:
                    break;
            }
        }
        return redirect()->route('superProduct');
    }
    public function nameToSlug($str) {
        if(!$str) return false;
        $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-'=>' ',
            ''=>'/',
            ''=>',');
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        return strtolower($str);
    }
    public function viToEng($str) {
        if(!$str) return false;
        $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            ''=>' ');
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        return strtolower($str);
    }
}
