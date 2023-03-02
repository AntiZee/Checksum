<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    function store(Request $r)
    {
        $now = Carbon::now();
        $format = $now->format('D j-M-Y g:i:s.u A');
        $user = Auth::user();
        $certificate = new Certificate();
        $certificate->user_id = $user->id;
        $certificate->name = $r->input('name');
        $certificate->sha512 = $r->input('sha512');
        $certificate->time = $format;
        $certificate->save();
        $certificates = Certificate::where('user_id', $user->id)->orderBy('time')->get();
        return redirect('/')->with('certificates', $certificates);
    }
}