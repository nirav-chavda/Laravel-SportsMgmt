<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }
    public function postLogin(Request $request)
    {

    $this->validate($request, [
        'username' => 'required', 'password' => 'required|min:6',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials, $request->has('remember')))
    {
       // $userID = \Auth::user()->id;

        if(Auth::user()->isAdmin == 1) {
            return redirect()->route('admin.home');
        } 
        else if (Auth::user()->isHost == 1) {
            return redirect()->route('host.home');
        } else if (Auth::user()->isCrew == 1) {
            return redirect()->route('crew.home');
        }
    }
    \Session::flash('message', ['msg'=>'Login failed. Check your data.', 'class'=>'red']);
    return redirect()->route('login');
}
}
