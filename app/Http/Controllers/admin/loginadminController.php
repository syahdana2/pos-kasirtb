<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class loginadminController extends Controller
{
    public function login_admin(){
        return view('admin.login');
    }

    public function auth_admin(Request $request): RedirectResponse{
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
        return back()->with('loginError', 'Login not falid');
    }
}
