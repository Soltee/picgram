<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

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

    public function showLoginForm(){

        return view('welcome')->with('type', 'login');
    }

    /* public function login(Request $request) */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string|min:8'
        ]);

        //Find User By Email
        $user   = User::where('email' , $data['email'])->first();
        if(!$user)
        {   
            return response()->json([
                    'message'  => 'The given data was invalid.',
                    'errors'   => [
                        'email'  => [
                                'The credentials doesnot match.'
                            ]
                    ]
                ], 422);
        }

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->input('remember'))) {
            return response()->json([
                    'message'  => 'The given data was invalid.',
                    'errors'   => [
                        'password'  => [
                                'The credentials doesnot match.'
                            ]
                    ]
                ], 422);
        } 

        return response()->json([
                    'message'  => 'The login was successful.',
                    'login'    => 'ok.'
                ], 200);
        

    }


    /*
        * Invalidate Session and logout
    */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/')->with('success', 'Logged out successfully.');
    }
}
