<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request){
        if (Auth::user()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.pages.login');
    }
    function authenticate(Request $request){
        $request->flash();
        $remember=$request->has('remember') ? true:false;
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials,$remember)){
            return redirect()->intended(route('admin.dashboard'));
        }else{
            return back()->with('error','E-Posta Veya Şifre Yanlış');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect(route('admin.login'))->with('success','Güvenli Çıkış Yapıldı');
    }
}
