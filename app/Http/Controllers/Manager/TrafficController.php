<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traffic;
class TrafficController extends Controller
{
    public function getViewEachDay(Request $req){
        $traffic = new Traffic;
        $validatedData = $req->validate([
            'month'=>'digits_between:1,12'
        ]);
        return $traffic->getViewEachDay($validatedData['month']);
    }
}
