<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    function showResetForm(Request $r)
    {
        $email = $r->email;
        return view('newpassword', compact('email'));
    }
    function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);
        $response = $this->broker()->reset(
            $request->only('password', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );
        if ($response === Password::PASSWORD_RESET) {
            return redirect('login')->with('status', 'Password has been reset.');
        } else {
            return back()->withErrors(['email' => 'Unknown error. Please try again later.']);
        }
    }
    private function broker()
    {
        return Password::broker();
    }
}