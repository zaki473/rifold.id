<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function registerPage()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }


    public function loginPage()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }

        return back()->with('error', 'email password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
