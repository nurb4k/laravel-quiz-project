<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->intended('/quizzes');
        }
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',

        ]);

        if (Auth::attempt($validated)) {
            $result = (__('messages.welcome'));
            $result = $result.Auth::user()->name;

            if (Auth::user()->role->name == "admin")
                return redirect()->intended('/adm/users')->with('status', $result);

            return redirect()->intended('/quizzes')->with('status', $result);
        }
        return back()->withErrors('Incorrect email or password');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('quizzes.index');
    }
}
