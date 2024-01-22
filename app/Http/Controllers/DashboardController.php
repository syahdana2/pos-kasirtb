<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\product;
use App\Models\Employee;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $lowStockSum = DB::table('products as P')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select(DB::raw('COUNT(P.stock) as totalLowStock'))
            ->where('O.id', $outletId)
            ->where('P.stock', '<', 5)
            ->first();

        $totalLowStock = $lowStockSum->totalLowStock;

        $customerCount = Customer::count();

        $transactionCount = Transaction::count();

        $productCount = DB::table('products as P')
        ->join('employees as E', 'P.employee_id', '=', 'E.id')
        ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
        ->where('O.id', $outletId)
        ->count('P.name_product');

        $totalItem = [
            'totalTransaction' => $transactionCount,
            'totalCustomer' => $customerCount,
            'totalProduct' => $productCount,
            'totalLowStock' => $totalLowStock,
        ];

        $queryResultHariIni = DB::table('transactions')
            ->select(DB::raw('COUNT(id) as jumlahtransaksi'))
            ->whereDate('transactions.created_at', '=', now()->toDateString())
            ->first();
        $jumlahTransaksiHariIni = $queryResultHariIni->jumlahtransaksi;

        $queryResultMingguIni = DB::table('transactions')
            ->select(DB::raw('COUNT(id) as jumlahtransaksi'))
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();
        $jumlahTransaksiMingguIni = $queryResultMingguIni->jumlahtransaksi;

        $queryResultBulanIni = DB::table('transactions')
            ->select(DB::raw('COUNT(id) as jumlahtransaksi'))
            ->whereMonth('transactions.created_at', '=', date('m'))
            ->first();
        $jumlahTransaksiBulanIni = $queryResultBulanIni->jumlahtransaksi;

        $queryResultTahunIni = DB::table('transactions')
            ->select(DB::raw('COUNT(id) as jumlahtransaksi'))
            ->whereYear('transactions.created_at', '=', now()->year)
            ->first();
        $jumlahTransaksiTahunIni = $queryResultTahunIni->jumlahtransaksi;

        $totalTransaksi = [
            'hariIni' => $jumlahTransaksiHariIni,
            'mingguIni' => $jumlahTransaksiMingguIni,
            'bulanIni' => $jumlahTransaksiBulanIni,
            'tahunIni' => $jumlahTransaksiTahunIni,
        ];

        $subtotalHariIni = DB::table('transactions')
            ->select(DB::raw('SUM(subtotal) as total'))
            ->whereDate('transactions.created_at', '=', now()->toDateString())
            ->first();
        $subtotalTransaksiHariIni = $subtotalHariIni->total;

        $subtotalMingguIni = DB::table('transactions')
            ->select(DB::raw('SUM(subtotal) as total'))
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();
        $subtotalTransaksiMingguIni = $subtotalMingguIni->total;

        $subtotalBulanIni = DB::table('transactions')
            ->select(DB::raw('SUM(subtotal) as total'))
            ->whereMonth('transactions.created_at', '=', date('m'))
            ->first();
        $subtotalTransaksiBulanIni = $subtotalBulanIni->total;

        $subtotalTahunIni = DB::table('transactions')
            ->select(DB::raw('SUM(subtotal) as total'))
            ->whereYear('transactions.created_at', '=', now()->year)
            ->first();
        $subtotalTransaksiTahunIni = $subtotalTahunIni->total;

        $subtotalTransaksi = [
            'hariIni' => $subtotalTransaksiHariIni,
            'mingguIni' => $subtotalTransaksiMingguIni,
            'bulanIni' => $subtotalTransaksiBulanIni,
            'tahunIni' => $subtotalTransaksiTahunIni,
        ];

        return view('employee.dashboard', compact('emp', 'totalItem', 'totalTransaksi', 'subtotalTransaksi'), ["title" => "Dashboard Employee"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
