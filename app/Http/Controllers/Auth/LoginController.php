<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;

use Validator;
use Auth;
use Hash;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:6',
        ]);
        if ($v->fails()) return back()->withErrors($v->errors());

        $auth_attempt = [
            'email' => $request->post('email'), // admin@admin.com
            'password' => $request->post('password'), // password
        ];

        if ($user = Auth::attempt($auth_attempt)) {

            return redirect()->route('company.index');
        }
        else {
            return back()->withInput()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Incorrect email or password!',
            ]);
        }

        dd("Hi, How are you doing?!");
    }
}
