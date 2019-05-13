<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function getLogin($isAdmin = false)
    {
        if($isAdmin == true){
            $url = 'admin/login';
            $typeUser = 'Admin';
        }else{
            $url = 'login/';
            $typeUser = 'Member';
        }

        return view('auth.login')->with(compact('url','typeUser'));
    }

    public function postLogin(Request $request, $guard='web')
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $remember = ($request->remember=='Remember Me')?true:false;

        if(Auth::guard($guard)->attempt($request->only(['email','password']),$remember)){
            if($guard=='admin') return redirect('admin/');
            else return redirect('/');
        }else{
            return back()->withInput()->withErrors(['login'=>'Username/Password mismatch']);
        };
    }
    public function logOut($guard='web')
    {
        Auth::guard($guard)->logout();
        if($guard=='admin') return redirect('/admin/login')->with('msg','Logout Success');
        elseif ($guard == 'web') return redirect('login/')->with('msg', 'Logout Success');
    }
}
