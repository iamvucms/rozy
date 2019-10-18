<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\Customer;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function Login(){
        return 'hello';
    }
    public function GoogleLoginRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function GoogleCallBackHandler(){
        $google = Socialite::driver('google')->stateless()->user();
        if($google->id ===null) return redirect(url('/'));
        $user =User::where('email',$google->email);
        if($user->count()>0){
            Auth::loginUsingId($user->first()->id);
            if($user->first()->Avatar()->count()==0){
                $user->first()->Avatar()->create(['id_avt_user'=>$user->first()->id,'src'=>$google->avatar]);
            }   
        }else{
            $user = new User;
            $user->email = $google->email;
            $user->google_id=$google->id;
            $user->save();
            $user->Avatar()->create(['id_avt_user'=>$user->id,'src'=>$google->avatar]);
            Customer::insert(['user_id'=>$user->id,'name'=>$google->name]);
            Auth::loginUsingId($user->id);
        }
        return redirect($this->redirectTo);
    }
}
