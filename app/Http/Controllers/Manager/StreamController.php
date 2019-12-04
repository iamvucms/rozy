<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Stream;
class StreamController extends Controller
{
    public function show(){
        $user = Auth::user();
        if($user->role_id==1){
            $streams = Stream::with('Seller')->with('Category')->paginate(20);
            return view('Admin.streaming',compact('streams'));
        }elseif($user->role_id==3) return view('Admin.streaming');
        else return abort(403);
    }
    public function addStream(Request $req){
        $user = Auth::user();
        if($user->role_id==1) return response()->json(['success'=>false], 200, []);
        Stream::updateOrCreate(
            ['idsell'=>$user->Seller()->id],
            [
                'description'=>$req->description,
                'idcat'=>$req->idcat ?? 0,
                'stream_key' =>trim($req->id),
                'status'=>'1'
            ]);
        return response()->json(['success'=>true], 200, []);
    }
}
