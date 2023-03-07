<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index(Request $r)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $certificates = Certificate::where('user_id', $user->id)->orderBy('time')->get();
            return view('main', compact('certificates'));
        } else {
            return view('main');
        }
    }
}