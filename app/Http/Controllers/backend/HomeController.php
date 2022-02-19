<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            return view('backend.pages.home');
        }else{
            return redirect()->route('admin.login');
        }
    }
}
