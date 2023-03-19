<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'in:on'
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            session()->flash('message', 'Login Successfully');
            return redirect()->route('adminHome');
        } else {
            session()->flash('message', 'Login failed');
            return redirect()->route('admin.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }

    public function change_password()
    {
        return view('admin.auth.change-password');
    }

    public function post_change_password(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string|confirmed'
        ]);

        $user = auth()->user();

        if (Hash::check($request->get('oldPassword'), $user->password)) {
            $user->password = Hash::make($request->get('newPassword'));
            $user->save();
            return redirect()->route('adminHome');
        } else {
            return redirect()->back();
        }
    }
}
