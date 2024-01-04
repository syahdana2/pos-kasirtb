<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Outlet;

class outletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admin::find(session()->get('auth_id'));
        // dd($admin);
        $dt_outlet = Outlet::orderBy('created_at', 'DESC')->get();
        return view('admin.crud-outlet.outlet', compact('admin', 'dt_outlet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $admin = Admin::find(session()->get('auth_id'));
        return view('admin.crud-outlet.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_outlet' => 'required|unique:outlets',
            'phone' => 'required|min:10',
            'address' => 'required|max:225',
        ]);

        Outlet::create($validated);

        return redirect()->route('outlet')->with('success', 'Berhasil menambahkan data toko baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Admin::find(session()->get('auth_id'));
        $outlet = Outlet::findOrFail($id);
        return view('admin.crud-outlet.edit', compact('outlet', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_outlet' => 'max:100',
            'phone' => 'min:10',
            'address' => 'max:225'
        ]);

        // Outlet::whereId($id)->update($validated);
        Outlet::findOrFail($id)->update($validated);
        // dd($validated);

        return redirect()->route('outlet')->with('success', 'Toko berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $outlets = Outlet::findOrFail($id);
        $outlets->delete();

        return redirect()->route('outlet')->with('success', 'Toko berhasil dihapus');
    }
}
