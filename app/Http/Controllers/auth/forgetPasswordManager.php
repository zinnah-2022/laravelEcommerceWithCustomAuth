<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class forgetPasswordManager extends Controller
{
   public function index(){
       return view('auth.forget_password');
   }
   public function forgetPassword(Request $request){
       $request->validate([
           'email'=>'required|email|exists:users'
       ]);
       $token=Str::random('64');
       DB::table('password_resets')->insert([
           'email'=>$request->email,
           'token'=>$token,
           'created_at'=>Carbon::now()
       ]);

       Mail::send('admin.email.forget_password', ['token'=>$token], function ($message) use ($request){
           $message->to($request->email);
           $message->subject('Forget Password');

       });
       return redirect()->route('forgetPassword')->with('success','massage send Successfully, check your Email');


   }
   public function resetPassword($token){
       return view('auth.reset_password', compact('token'));

   }
   public function resetPasswordPost(Request $request){
       $request->validate([
           'email'=>'required|email|exists:users',
           'password'=>'required|string|min:6|confirmed',
           'password_confirmation'=>'required',
       ]);
       $check_user=DB::table('password_resets')->where([
           'email'=>$request->email,
           'token'=>$request->token
       ])->first();

       if (!$check_user){
           return redirect()->back()->with('error','Invalid');
       }
       else{
           DB::table('users')->
           where('email', $request->email)->
           update(['password'=>Hash::make($request->password)]);
       }
       DB::table('password_resets')->where(['email'=>$request->email])->delete();
       return redirect()->route('login');


   }
}
