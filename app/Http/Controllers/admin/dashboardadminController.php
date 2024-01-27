<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Models\outlet;
use App\Models\Employee;
use App\Models\detail_transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class dashboardadminController extends Controller
{
    public function index()
    {
        $admin = Admin::find(session()->get('auth_id'));
        $outletCount = outlet::count();
        $employeeCount = Employee::count();

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
        
        $dt_outlet = Outlet::orderBy('created_at', 'DESC')->get();

        return view('admin.dashboard', compact('admin', 'outletCount', 'employeeCount', 'dt_outlet'));
    }
}
