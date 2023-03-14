<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{
    function index()
    {
        return view('forgot');
    }
    function forgot(Request $r)
    {
        $r->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Please enter an email address.'
        ]);
        $response = $this->broker()->sendResetLink(
            $r->only('email')
        );
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return back()->with('status', 'Reset password link sent. Don\'t forget to check the spam too.');
            case Password::INVALID_USER:
                return back()->withErrors(['email' => 'The email is not registered.']);
            case Password::INVALID_TOKEN:
                return back()->withErrors(['email' => 'Invalid token.']);
            case Password::RESET_THROTTLED:
                return back()->withErrors(['email' => 'Reset email sent too frequently. Please wait and try again.']);
            default:
                return back()->withErrors(['email' => 'Unknown error. Please try again later.']);
        }
    }
    private function broker()
    {
        return Password::broker();
    }
}