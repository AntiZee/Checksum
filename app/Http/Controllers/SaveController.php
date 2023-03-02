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
        $u = Auth::user();
        $c = new Certificate();
        $c->user_id = $u->id;
        $c->name = $r->input('name');
        $c->sha512 = $r->input('sha512');
        $c->time = $format;
        $c->save();
        return redirect('/');
    }
}