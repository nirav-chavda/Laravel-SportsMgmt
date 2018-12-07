<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\tournament;
use Illuminate\Http\Request;
use Auth;

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
    public function showLoginForm(){
        return view('auth..login');
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/tournaments');
      }
    // public function logout(){
    //     $tmntsF=tournament::all()->where('Sport_Id',1);
    //     $tmntsH=tournament::all()->where('Sport_Id',2);
    //     $tmntsK=tournament::all()->where('Sport_Id',3);
    //     return view('pages.home')->with(['tmntsF'=>$tmntsF,'tmntsH'=>$tmntsH,'tmntsK'=>$tmntsK]);
    // }
    // protected function authenticated(Request $request, User $user)
    // {
    //     return redirect()->intended();
    // }
}
