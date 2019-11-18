<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seller;
class SellerController extends Controller
{
    public function show(){
        $user = Auth::user();
        $sellers = Seller::paginate(20);
        if($user->role_id!=1) abort(403); 
        return view('Admin.supplier',compact('sellers'));
    }
    public function editSeller($id){
        $seller = Seller::find($id);
        return view('Admin.editsup',compact('seller'));
    }
}
