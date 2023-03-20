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
            $certificates = Certificate::where('user_id', $user->id)->orderByRaw("STR_TO_DATE(time, '%a %d-%b-%Y %h:%i:%s.%f %p') ASC")->get();
            return view('main', compact('certificates'));
        } else {
            return view('main');
        }
    }
}