<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class employeeController extends Controller
{
    public function index (){
        $admin = Admin::find(session()->get('auth_id'));
        $dt_employee = Employee::orderBy('created_at', 'DESC')->get();
        return view('admin.crud-employee.employee', compact('admin', 'dt_employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
        $admin = Admin::find(session()->get('auth_id'));
        $outlet = outlet::all();
        return view('admin.crud-employee.create', compact('admin', 'outlet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'outlet_id' => 'required',
            'name_employee' => 'required',
            'username' => 'required|unique:employees',
            'password' => 'required|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);
    
        Employee::create($validated);
    
        return redirect()->route('employee')->with('success', 'Berhasil menambahkan data kasir');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $admin = Admin::find(session()->get('auth_id'));
        $employee = Employee::findOrFail($id);
        $outlet = outlet::all();
        return view('admin.crud-employee.edit', compact('employee', 'admin', 'outlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $validated = $request->validate([
            'name_employee' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        Employee::findOrFail($id)->update($validated);
        return redirect()->route('employee')->with('success', 'Kasir berhasil diedit');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employees = Employee::findOrFail($id); 
        $employees->delete();
        
        return redirect()->route('employee')->with('success', 'Kasir berhasil dihapus');
    }
}
