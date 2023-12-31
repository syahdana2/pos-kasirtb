<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class authController extends Controller
{
    // public function login()
    // {
    //     $checkauth = Admin::where('id', session()->get('auth_id'))->first();
    //     if ($checkauth) return abort(403);

    //     return view('admin.login');
    // }

    public function login_admin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $user_admin = DB::selectOne('SELECT * FROM admins WHERE username =?', [$credentials['username']]);
        if (!$user_admin){
            return redirect()->route('admin.login')->with('error', 'Username has not been registered');
        } 
        if (!HASH::check($credentials['password'], $user_admin->password)){
            return redirect()->route('admin.login')->with('error', 'username or password failed');
        } 

        session()->put('auth_id', $user_admin->id);
        // dd($user_admin);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('admin.login')->with('success', 'You have successfully logged out');
    }

    public function login_employee(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $user_employee = DB::selectOne('SELECT * FROM employees WHERE username = ?', [$validated['username']]);
        if (!$user_employee){
            return redirect()->route('employee.login')->with('error', 'username has not been registered');
        }
        if (!HASH::check($validated['password'], $user_employee->password)){
            return redirect()->route('employee.login')->with('error', 'username or password failed');
        } 
        session()->put('auth_id', $user_employee->id);
        // dd($user_employee);
        return redirect()->route('employee.dashboard');
    }

    public function logout_employee()
    {
        Session::flush();

        return redirect()->route('employee.login')->with('success', 'You have successfully logged out');
    }

}
