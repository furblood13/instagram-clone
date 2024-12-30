<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Try to authenticate
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('surveys.index');
        }

        // If authentication fails, create new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->username . '@example.com', // Geçici email
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('surveys.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
