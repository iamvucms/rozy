<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enjoy;

class EnjoyController extends Controller
{
    public function addEnjoy(Request $req){
        $enjoy = new Enjoy();
        $result = $enjoy->addItem($req->id,$req->type);
        return response()->json(['success'=>$result], 200, []);
    }
    public function delEnjoy(Request $req){
        $enjoy = new Enjoy();
        if($req->type==null) $result = $enjoy->delItem($req->id);
        else $result = $enjoy->delItem($req->id,$req->type);
        return response()->json(['success'=>$result], 200, []);
    }
}
