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
        $v = $r->validate([
            'email' => 'required|email|unique:users',
            'pass' => 'required|min:6'
        ], [
            'email.unique' => 'The email has already been taken.'
        ]);
        $u = new User();
        $u->email = $v['email'];
        $u->password = Hash::make($v['pass']);
        $u->save();
        return redirect('/login');
    }
}