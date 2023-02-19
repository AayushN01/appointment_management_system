<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerForm()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success','User has been registered successfully');
    }

    public function loginForm()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user_creds = $request->except('_token');
        if(Auth::attempt($user_creds)){
            return redirect()->route('home');
        }else{
            return back()->with('error','Oops! Wrong Credentials');
        }
    }

    public function home()
    {
        if(Auth::check())
        {
            return view('home');
        }else {
            return redirect()->route('login_form');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login_form');
    }
}
