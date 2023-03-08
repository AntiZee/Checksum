<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    function showResetForm()
    {
        return view('new');
    }
    function reset(Request $r)
    {
        $r->validate($this->rules());

        $this->broker()->reset(
            $this->credentials($r),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return redirect('login')->with('status', 'Password has been reset!');
    }
    private function rules()
    {
        return [
            'password' => 'required|min:6',
        ];
    }
    private function broker()
    {
        return Password::broker();
    }
}