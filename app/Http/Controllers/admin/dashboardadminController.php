<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\outlet;
use Illuminate\Support\Facades\Auth;

class dashboardadminController extends Controller
{
    public function index () {
    $admin = Admin::find(session()->get('auth_id'));
    $outletCount = outlet::count();
    $employeeCount = Employee::count();
    return view('admin.dashboard', compact('admin', 'outletCount', 'employeeCount'));
    }
}
