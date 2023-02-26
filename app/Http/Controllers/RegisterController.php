<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function index()
    {
        return view('register');
    }
    function store(Request $r)
    {
        $r->validate([
            'email' => 'required|email|unique:users',
            'pass' => 'required|min:6'
        ]);
        dd('berhasil');
    }
}