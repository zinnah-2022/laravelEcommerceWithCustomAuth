<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
   public function index(){
       return view('auth/register');
   }
   public function register(Request $request){
       $request->validate([
           'name' => ['required', 'string', 'max:255'],
           'phone' => ['required'],
           'status' => ['required'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
           'password' => ['required'],
       ]);

       $user = User::create([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'status' => $request->status
       ]);
           Auth::login($user);
           $request->session()->regenerate();
           return redirect(RouteServiceProvider::HOME);

   }

   public function welcome(){

       return view('welcome');
   }
    public function dashboard(){
        return view('admin/layout/index');

    }
    public function logout(Request $request)
    {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('welcome');


        

    }
}
