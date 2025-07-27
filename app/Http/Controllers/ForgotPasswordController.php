<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    const title = 'Forgot Password - We Care';
    public function forgotpassword()
    {
        return view('auth.forgot-password', [
            'title' => self::title
        ]);
    }


    public function createtoken(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
            ]);

        Mail::send('mail.forgot-password', ['token' => $token, 'title' => 'We Care'], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('sukses', 'Kami telah mengirim email tautan reset kata sandi Anda!');
    }

    public function resetpassword($token) {
        $email = DB::table('password_resets')->where(['token' => $token])->value('email');
        return view('auth.forgot-password-form', [
            'token' => $token,
            'email' => $email,
            'title' => self::title
        ]);
    }


    public function sendresetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8',
            'password_confirm' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$updatePassword){
            return back()->withInput()->with('message', 'Invalid token!');
        }
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['token'=> $request->token])->delete();
        return redirect('/login')->with('message', 'Kata sandi Anda telah diubah!');
    }
}
