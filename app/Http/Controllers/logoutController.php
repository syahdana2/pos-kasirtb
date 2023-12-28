<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class logoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        Request()->session()->invalidate();

        Request()->session()->regenerateToken();

        return redirect('/');
    }
}
