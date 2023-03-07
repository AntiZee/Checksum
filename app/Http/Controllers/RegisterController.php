<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    function index()
    {
        return view('register');
    }
    function store(Request $r)
    {
        $valid = $r->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 6 characters.'
        ]);
        $user = new User();
        $user->email = $valid['email'];
        $user->password = Hash::make($valid['password']);
        $user->save();
        return redirect('login');
    }
}