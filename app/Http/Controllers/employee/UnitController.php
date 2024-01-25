<?php

namespace App\Http\Controllers\employee;

use Carbon\Carbon;
use App\Models\unit;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Employee;
use App\Exports\UnitExport;
use App\Imports\UnitImport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

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
        return redirect()->route('unit_page')->with('success', 'Data Berhasil Di Edit');
    }

    //hapus unit
    public function deleteunit($id)
    {
        $data = unit::find($id);
        $data->delete();
        return redirect()->route('unit_page')->with('success', 'Data Berhasil Di Hapus');
    }

    public function exportPDF() {
        $unit = unit::all();
        $outlet = outlet::find(session('outlet_id'));
        $today = Carbon::now()->format('d M Y');
        $details = ['title' => 'printPDF'];

        //return view('employee.crud-unit.unit-pdf', compact('unit','outlet','today'), $details);
        view()->share('unit', $unit);
        view()->share('today', $today);
        view()->share('outlet', $outlet);
        //return view('employee.crud-unit.unit-pdf');
        $pdf = PDF::loadview('employee.crud-unit.unit-pdf', $details);
        $fileName = 'data satuan unit toko'  . Str::slug($outlet->name_outlet) . ' ' . $today . '.pdf';
        return $pdf->download($fileName);
        PDF::loadView($pdf)->setPaper('a4', 'landscape')->setWarnings(false)->save($fileName);
    }

    public function exportEXCEL(){
        $outlet = outlet::find(session('outlet_id'));
        $today = Carbon::now()->format('d M Y');
        $fileName = 'Data satuan unit toko ' . Str::slug($outlet->name_outlet) . ' ' . $today . '.xlsx';
        return Excel::download(new unitExport, $fileName);
    }

    public function importData(Request $request) 
	{
		// validasi 

		// menangkap file excel
		$file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('file_unit',$nama_file);
        Excel::import(new UnitImport, public_path('/file_unit/'.$nama_file));

        //alihkan kembali halaman dan beri notifikasi sukses
        return redirect()->route('unit_page')->with('sukses','Data Siswa Berhasil Diimport!');
	}
}
