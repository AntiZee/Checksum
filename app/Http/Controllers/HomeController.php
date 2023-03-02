<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $certificates = Certificate::where('user_id', $user->id)->orderBy('time')->get();
            return view('index', compact('certificates'));
        } else {
            return view('index');
        }
    }
}