<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
       return view('auth/login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::HOME);
        }
    }



}
