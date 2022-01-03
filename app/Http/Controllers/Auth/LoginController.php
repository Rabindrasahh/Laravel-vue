<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;

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

    public function login(Request $request)
    {



        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            return response()->json(['success' => 'You are login successfully'], 200);
        } else {
            return response()->json(['error' => 'Wrong Email Or Password Please Try Again'], 422);
        };
        $_SESSION['authuser'] = '1';
        return $user->createToken($request->device_name)->plainTextToken;
    }
    public function logout(Request $request)
    {

        $logout = Auth::logout();

        if ($logout) {
            $_SESSION['authuser'] = '1';
            Session::flush();
            return redirect('/');
        }
    }
}
