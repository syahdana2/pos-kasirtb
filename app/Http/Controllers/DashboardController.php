<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\detail_transaction;
use App\Models\Transaction;
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

        $totalLowStock = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

        $customer = Customer::join('outlets as O', 'customers.outlet_id', '=', 'O.id')
        ->selectRaw('COUNT(customers.id) as totalCustomer')
        ->where('O.id', $outletId)
        ->first();

        $customerCount = $customer->totalCustomer;

        $total = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
        ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
        ->selectRaw('COUNT(transactions.id) as totalTransaction')
        ->where('O.id', $outletId)
        ->first();

        $transactionCount = $total->totalTransaction;


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

        $queryResultHariIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('COUNT(transactions.id) as jumlahtransaksi')
            ->where('O.id', $outletId)
            ->whereDate('transactions.created_at', '=', now()->toDateString())
            ->first();
        $jumlahTransaksiHariIni = $queryResultHariIni->jumlahtransaksi;

        $queryResultMingguIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('COUNT(transactions.id) as jumlahtransaksi')
            ->where('O.id', $outletId)
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();
        $jumlahTransaksiMingguIni = $queryResultMingguIni->jumlahtransaksi;

        $queryResultBulanIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('COUNT(transactions.id) as jumlahtransaksi')
            ->where('O.id', $outletId)
            ->whereYear('transactions.created_at', '=', now()->year)
            ->whereMonth('transactions.created_at', '=', now()->month)
            ->first();
        $jumlahTransaksiBulanIni = $queryResultBulanIni->jumlahtransaksi;

        $queryResultTahunIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('COUNT(transactions.id) as jumlahtransaksi')
            ->where('O.id', $outletId)
            ->whereYear('transactions.created_at', '=', now()->year)
            ->first();
        $jumlahTransaksiTahunIni = $queryResultTahunIni->jumlahtransaksi;

        $totalTransaksi = [
            'hariIni' => $jumlahTransaksiHariIni,
            'mingguIni' => $jumlahTransaksiMingguIni,
            'bulanIni' => $jumlahTransaksiBulanIni,
            'tahunIni' => $jumlahTransaksiTahunIni,
        ];

        $subtotalHariIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(subtotal) as total')
            ->where('O.id', $outletId)
            ->whereDate('transactions.created_at', '=', now()->toDateString())
            ->first();
        $subtotalTransaksiHariIni = $subtotalHariIni->total;

        $subtotalMingguIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(subtotal) as total')
            ->where('O.id', $outletId)
            ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();
        $subtotalTransaksiMingguIni = $subtotalMingguIni->total;

        $subtotalBulanIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(subtotal) as total')
            ->where('O.id', $outletId)
            ->whereYear('transactions.created_at', '=', now()->year)
            ->whereMonth('transactions.created_at', '=', now()->month)
            ->first();
        $subtotalTransaksiBulanIni = $subtotalBulanIni->total;

        $subtotalTahunIni = Transaction::join('employees as E', 'transactions.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(subtotal) as total')
            ->where('O.id', $outletId)
            ->whereYear('transactions.created_at', '=', now()->year)
            ->first();
        $subtotalTransaksiTahunIni = $subtotalTahunIni->total;

        $subtotalTransaksi = [
            'hariIni' => $subtotalTransaksiHariIni,
            'mingguIni' => $subtotalTransaksiMingguIni,
            'bulanIni' => $subtotalTransaksiBulanIni,
            'tahunIni' => $subtotalTransaksiTahunIni,
        ];

        $updateProduct = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereYear('products.updated_at', '=', now()->year)
            ->whereMonth('products.updated_at', '=', now()->month)
            ->get();

        $topProduct = DB::table('detail_transactions')
            ->join('products', 'detail_transactions.product_id', '=', 'products.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('products.id', 'products.name_product', 'units.satuan as product_unit',
                DB::raw('CAST(SUM(detail_transactions.qty) AS UNSIGNED) as total_qty')
            )
            ->where('O.id', $outletId)
            ->groupBy('products.id', 'products.name_product', 'units.satuan')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->get();

        $detailTransactions = detail_transaction::join('transactions as T', 'detail_transactions.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(profit) as total')
            ->where('O.id', $outletId)
            ->whereDate('T.created_at', now()->toDateString())
            ->first();
        $totalProfitToday = $detailTransactions->total;

        $detailTransactions = detail_transaction::join('transactions as T', 'detail_transactions.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(profit) as total')
            ->where('O.id', $outletId)
            ->whereBetween('T.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();
        $totalProfitWeek = $detailTransactions->total;

        $detailTransactions = detail_transaction::join('transactions as T', 'detail_transactions.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(profit) as total')
            ->where('O.id', $outletId)
            ->whereYear('T.created_at', '=', now()->year)
            ->whereMonth('T.created_at', '=', now()->month)
            ->first();
        $totalProfitMonth = $detailTransactions->total;

        $detailTransactions = detail_transaction::join('transactions as T', 'detail_transactions.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('SUM(profit) as total')
            ->where('O.id', $outletId)
            ->whereYear('T.created_at', '=', now()->year)
            ->first();
        $totalProfitYear = $detailTransactions->total;
        
            $totalProfit = [
                'hariIni' => $totalProfitToday,
                'mingguIni' => $totalProfitWeek,
                'bulanIni' => $totalProfitMonth,
                'tahunIni' => $totalProfitYear,
            ];


        return view('employee.dashboard', compact('emp', 'totalLowStock', 'totalItem', 'totalTransaksi', 'updateProduct', 'subtotalTransaksi', 'topProduct', 'totalProfit'), ["title" => "Dashboard Employee"]);
    }
}
