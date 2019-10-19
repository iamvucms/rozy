<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ResetPasswordRequest;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $req){
        $user = User::where('email',$req->email);
        if($user->count()==0) return response()->json(['message' => 'Không tìm thấy email ','success'=>false], 200, []);;
        $code = rand(10000,99999);
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->first()->email,
        ],[
            'token' => $code,
        ]);
        if ($passwordReset) {
            $user->first()->notify(new ResetPasswordRequest($code));
        }
        return response()->json(['message' => 'Email đã được gửi đi vui lòng nhập mã <br>nhận được có 5 chữ số vào ô dưới','success'=>true], 200, []);
    }
    public function postRecovery(Request $req){
        $sessionRecoveryEmail = $req->session()->get('emailRecovery');
        if($req->email != $sessionRecoveryEmail) return response()->json(['success'=>false,'message'=>'Lỗi hệ thống, vui lòng thử lại'], 200, []);
        else{
            $user = User::where('email',$req->email)->first();
            $user->password = bcrypt($req->password);
            $user->save();
        }
        return response()->json(['success'=>true,'message'=>'Đổi mật khẩu thành công!'], 200, []);
    }
    public function postReset(Request $req){
        $user = User::where('email',$req->email);
        $passwordReset = PasswordReset::where([['email','=',$req->email],['token','=',$req->code]]);
        if($user->count()==0 || $passwordReset->count()==0) return response()->json(['canRecovery'=>false,'message'=>'Mã xác minh không chính xác'], 200, []);
        $req->session()->put('emailRecovery', $user->first()->email);
        return response()->json(['canRecovery'=>true], 200, []);
    }
}
