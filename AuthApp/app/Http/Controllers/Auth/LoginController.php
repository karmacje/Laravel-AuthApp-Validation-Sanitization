<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // LOGIN VALIDATION
    public function login(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'email'=>'required'
        ]);
        if(auth()->attempt(array('email'=>$input['email'],'password'=>$input
        ['password']))){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('login')->with('error','Input proper email/password.');
        }
    
        function validateLogin(Request $request)
        {
            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);
        }

    // LOGIN SANITIZATION
    function credentials(Request $request)
    {
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $password = $request->password;
    
        return ['email' => $email, 'password' => $password];
    }
    



    }
}