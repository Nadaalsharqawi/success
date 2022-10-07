<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(){
        $rem = request()->has('remember') ? true : false;
        if(auth()->attempt(['phone'=>request('phone') ,'password'=>request('password') , 'type'=>'super_admin'] , $rem)){
            return redirect()->home();
        }elseif(auth()->attempt(['phone'=>request('phone') ,'password'=>request('password') , 'type'=>'admin'] , $rem)){
            return redirect()->home();
        }elseif(auth()->attempt(['phone'=>request('phone') ,'password'=>request('password') , 'type'=>'company'] , $rem)){
            return redirect()->home();
        }else{
            session()->flash('error' , 'بيانات الاعتماد التي ادخلتها غير صحيحة');
            return redirect()->back();
        }
    }
}
