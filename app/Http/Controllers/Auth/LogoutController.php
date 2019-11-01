<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traffic;
use Carbon\Carbon;

class LogoutController extends Controller
{
    protected $redirect = '/';
    public function Logout(){
        $this->resetTraffic();
        Auth::logout();
        return redirect($this->redirect);
    }
    public function resetTraffic(){
        $user = Auth::user();
        $start = Carbon::parse($user->last_login,"Asia/Ho_Chi_Minh");
        $finish = Carbon::now("Asia/Ho_Chi_Minh");
        $diffInSecond = $finish->diffInSeconds($start);
        $traffic = Traffic::whereRaw("DAY(NOW())=DAY(updated_at) AND MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)")->first();
        if($traffic===null){
            Traffic::insert(['logout_count'=>1,'time'=>$diffInSecond]);
        }else{
            $traffic->logout_count = $traffic->logout_count+1;
            $traffic->time = $diffInSecond+$traffic->time;
            $traffic->save();
        }
    }
}
