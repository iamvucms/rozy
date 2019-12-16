<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Seller;
use App\Customer;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function GettingStarted(Request $req){
        $seller = Seller::where('id',$req->idsell)->first();
        if($seller===null) return response()->json(['success' =>false], 200, []);
        else{
            $user=Auth::user();
            $obj = new Message;
            $obj->idsell = $seller->id;
            $obj->idcus = $user->getInfo()->id;
            $obj->msg = 'Xin chào';
            $obj->position = 1;
            $obj->save();
            return response()->json(['success' =>true], 200, []);
        }
    }
    public function getMessagesBySeller(Request $req){
        $idsell = $req->idsell;
        $obj = new Message;
        $seller = Seller::find(intval($idsell));
        $user=Auth::user();
        if($seller===null || $user===null) return response()->json(['success'=>false], 200, []);
        return response()->json(['success'=>true,'data'=>$obj->getMessagesBySeller($user->getInfo()->id,$seller->id)], 200, []);
    }
    public function getMessagesByCustomer(Request $req){
        $idcus = $req->idcus;
        $obj = new Message;
        $customer = Customer::find(intval($idcus));
        $user=Auth::user();
        if($customer===null || $user===null) return response()->json(['success'=>false], 200, []);
        if($user->role_id==3){
            return response()->json(['success'=>true,'data'=>$obj->getMessagesBySeller($customer->id,$user->Seller()->id)], 200, []);
        }else{
            return response()->json(['success'=>false], 200, []);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
