<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    const title = 'Login - We Care';

    public function index()
    {
        return view('auth.login', [
            'title' => self::title
        ]);
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $email = $data['email'];
        $password = $data['password'];

        if (Auth::attempt(array('email' => $email, 'password' => $password, 'role' => 0))) {
            $request->session()->regenerate();
            return redirect('/admin');
        } else if (Auth::attempt(array('email' => $email, 'password' => $password, 'role' => 1))) {
            $request->session()->regenerate();
            return redirect('/');
        } else if (Auth::attempt(array('email' => $email, 'password' => $password, 'role' => 2))) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/login')->with('salah', 'Email atau kata sandi Anda salah!');
    }
}
