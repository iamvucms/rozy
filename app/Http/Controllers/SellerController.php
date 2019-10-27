<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Seller;

class SellerController extends Controller
{
    public function Shop(Request $req,$slug){
        $seller = Seller::where('slug',$slug)->first();
        if($seller===null ) abort(404);
        $data = $req->validate([
            'ordProp' =>'in:ALL,HOTSELL,CREATE,RATE,PRICE,PRICE,VIEW,NAME',
            'ordType' =>'in:DESC,ASC'
        ]);
        $products = $seller->Products();
        switch(@$data['ordProp']){
            case 'ALL':
                $products = $seller->getProducts();//SAME DEFAULT
            break;
            case 'HOTSELL':
                $products = $products->selectRaw('products.*')->where('idsell',$seller->id)
                ->join('orderdetails','products.id','=','orderdetails.idpro')
                ->groupBy('products.id')->orderByRaw('SUM(orderdetails.quantity) DESC')->paginate(20);
            break;
            case 'CREATE':
                $products = $products->where('idsell',$seller->id)->orderBy('id',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'RATE':
                $products = $products->where('idsell',$seller->id)->join('reviews','reviews.idpro','=','products.id')
                ->selectRaw("products.*")->groupBy('idpro')->orderByRaw('AVG(star) '.($data['ordType'] ?? 'ASC'))
                ->paginate(20);
            break;
            case 'PRICE':
                $products = $products->where('idsell',$seller->id)->orderBy('sale_price',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'NAME':
                $products = $products->where('idsell',$seller->id)->orderBy('name',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'VIEW':
                $products = $products->where('idsell',$seller->id)->orderBy('view_count',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            default:
                $products = $seller->getProducts();
            break;
        }
        $products = $products->appends($req->except('page'));
        return view('shop',compact("seller","products"));
    }
}
