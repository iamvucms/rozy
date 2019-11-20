<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\Customer;
use App\Traffic;

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
    public function Login(Request $req){
        
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->last_login_ip = $req->ip();
            $user->save();
            $this->resetTraffic();
            if($req->type=='PAYMENT'){
                return response()->json(['success'=>true], 200, []);
            }else return redirect()->back();
        }
        if($req->type=='PAYMENT'){
            return response()->json(['success'=>false], 200, []);
        }else return redirect()->back();
    }
    public function Register(Request $req){
        $validatedData = $req->validate([
            'name' =>'required|min:3',
            'email'=>'required|unique:users,email|email:rfc,dns',
            'password'=>'required|min:6',
            'phone' =>'required|digits:10',
            'address'=>''
        ]);
        $user = new User;
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->last_login = date('Y-m-d H:i:s');
        $user->role_id=4;
        $user->last_login_ip = $req->ip();
        $user->save();
        $this->resetTraffic();
        Customer::insert([
            'user_id'=>$user->id,
            'name'=>$validatedData['name'],
            'phone'=>$validatedData['phone'],
            'address'=>$validatedData['address'] ?? '',
        ]);
        Auth::loginUsingId($user->id);
        if($req->type=='PAYMENT'){
            return response()->json(['success'=>true], 200, []);
        }else return redirect()->back();
        

    }
    public function GoogleLoginRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function GoogleCallBackHandler(){
        $google = Socialite::driver('google')->stateless()->user();
        if($google->id ===null) return redirect(url('/'));
        $user = User::where('email',$google->email);
        if($user->count()>0){
            $preUser = $user->first();
            $preUser->last_login = date('Y-m-d H:i:s');
            $preUser->last_login_ip = $req->ip();
            $preUser->save();
            Auth::loginUsingId($user->first()->id);
            if($user->first()->Avatar()->count()==0){
                $user->first()->Avatar()->create(['id_avt_user'=>$user->first()->id,'src'=>$google->avatar]);
            }   
        }else{
            $user = new User;
            $user->email = $google->email;
            $user->google_id=$google->id;
            $user->role_id =4;
            $user->last_login = date('Y-m-d H:i:s');
            $user->last_login_ip = $req->ip();
            $user->save();
            $user->Avatar()->create(['id_avt_user'=>$user->id,'src'=>$google->avatar]);
            Customer::insert(['user_id'=>$user->id,'name'=>$google->name]);
            Auth::loginUsingId($user->id);
        }
        $this->resetTraffic();
        return redirect()->back();
    }
    public function resetTraffic(){
        $traffic = Traffic::whereRaw("DAY(NOW())=DAY(updated_at) AND MONTH(NOW())=MONTH(updated_at) AND YEAR(NOW())=YEAR(updated_at)")->first();
        if($traffic===null){
            Traffic::insert(['login_count'=>1]);
        }else{
            $traffic->login_count = $traffic->login_count+1;
            $traffic->save();
        }
    }
}
