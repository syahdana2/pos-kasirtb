<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $outletId = session('outlet_id');

        $product = DB::table('products as P')
            ->join('units as U', 'P.unit_id', '=', 'U.id')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.selling_price', 'P.buy_price', 'U.satuan as satuan_product', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
            ->where('O.id', $outletId)
            ->get();

        // dd($product);

        $lowStockSum = DB::table('products as P')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select(DB::raw('COUNT(P.stock) as totalLowStock'))
            ->where('O.id', $outletId)
            ->where('P.stock', '<', 5)
            ->first();

        // Mengakses hasil query
        $totalLowStock = $lowStockSum->totalLowStock;

        $emp = Employee::find(session()->get('auth_id'));

        return view('employee.data-product', compact('product', 'totalLowStock', 'emp'), ["title" => "Data Produk"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = Unit::all();
        return view('employee.crud-product.create', compact('unit'), ["title" => "Tambah Produk"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $employee = Employee::all();
        return view('employee.crud-product.show', compact('product', 'employee'), ["title" => "Detail Produk"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
