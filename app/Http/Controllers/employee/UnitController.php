<?php

namespace App\Http\Controllers\employee;

use App\Models\unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Product;

class UnitController extends Controller
{
    //halaman unit
    public function unit()
    {
        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $totalLowStock = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

        $data = unit::all();
        return view('employee.unit', compact('data', 'emp', 'totalLowStock'), ["title" => "Satuan"]);
    }

    //tambah unit
    public function addunit()
    {
        $emp = Employee::find(session()->get('auth_id'));
        return view('employee.crud-unit.add', compact('emp'), ["title" => "Tambah Unit"]);
    }


    public function newunit(Request $request)
    {
        $validator = $request->validate([
            'satuan' => ['required']
        ]);
        //dd($request->all());
        unit::create($validator);
        return redirect()->route('unit_page')->with('success', 'Data Berhasil Di Tambahkan');
    }


    //edit unit
    public function dataunit($id)
    {
        $emp = Employee::find(session()->get('auth_id'));
        $data = unit::find($id);
        //dd($data);
        return view('employee.crud-unit.edit', compact('data', 'emp'), ["title" => "Edit Data Satuan"]);
    }


    public function updateunit(Request $request, $id)
    {
        $data = unit::find($id);
        $data->update($request->all());
        return redirect()->route('unit_page')->with('success', 'Data Berhasil Di Ubah');
    }

    //hapus unit
    public function deleteunit($id)
    {
        $data = unit::find($id);
        $data->delete();
        return redirect()->route('unit_page')->with('success', 'Data Berhasil Di Hapus');
    }
}
