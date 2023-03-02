<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }
    function auth(Request $r)
    {
        $valid = $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Please enter an email address.',
            'password.required' => 'Please enter a password.'
        ]);
        $credential = [
            'email' => $valid['email'],
            'password' => $valid['password']
        ];
        if (Auth::attempt($credential)) {
            $r->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }
    function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/');
    }
}