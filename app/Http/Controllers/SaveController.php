<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class SaveController extends Controller
{
    function store(Request $r)
    {
        $c = new Certificate();
        $c->name = $r->input('name');
        $c->sha512 = $r->input('sha512');
        $c->save();
        return redirect('/');
    }
}