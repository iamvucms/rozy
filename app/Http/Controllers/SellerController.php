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
            'ordProp' =>'in:POPULAR,HOTSELL,CREATE,RATE,PRICE,PRICE,VIEW',
            'ordType' =>'in:DESC,ASC'
        ]);
        $products = $seller->Products();
        switch(@$data['ordProp']){
            case 'POPULAR':
            break;
            case 'HOTSELL':
            break;
            case 'CREATE':
            $products = $products->orderBy('id',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'RATE':
            $products = $products->join('reviews','reviews.idpro','=','products.id')
            ->selectRaw("products.*")->groupBy('idpro')->orderByRaw('AVG(star) '.($data['ordType'] ?? 'ASC'))
            ->paginate(20);
            break;
            case 'PRICE':
            $products = $products->orderBy('price',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'NAME':
            $products = $products->orderBy('name',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            case 'VIEW':
            $products = $products->orderBy('view_count',$data['ordType'] ?? 'ASC')->paginate(20);
            break;
            default:
            $products = $seller->getProducts();
            break;
        }
        return view('shop',compact("seller","products"));
    }
}
