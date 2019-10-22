<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
class NotifyController extends Controller
{
    public function Viewed(Request $req){
        $data = $req->validate([
            'id'=>'exists:notifications,id'
        ]);
        $notify = Notification::where('id',$data['id'])->where('is_all',0)->get();
        if($notify->count()==0) return response()->json(['success'=>false], 200, []);
        else{
            $notify = $notify->first();
            $notify->is_hidden = 1;
            $notify->save();
        }
    }
}
