<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Outlet;
use App\Models\product;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\detail_transaction;
use App\Models\unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function show($id)
    {
        $outletId = $id;

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

        $history = DB::table('transactions as T')
            ->join('detail_transactions as DT', 'DT.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('T.id', 'T.kode_invoice', 'T.additional_cost', 'T.subtotal', 'T.note', 'T.pay', 'T.change', 'T.created_at', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name', 'DT.profit as labaProfit')
            ->where('O.id', $outletId)
            ->whereDate('T.created_at', today())
            ->orderBy('T.created_at', 'desc')
            ->get();

        $lowStock = DB::table('products as P')
            ->join('units as U', 'P.unit_id', '=', 'U.id')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.minimal_stock', 'U.satuan as satuan_product', 'P.buy_price', 'P.selling_price')
            ->where('O.id', $outletId)
            ->whereBetween('P.stock', [0, DB::raw('P.minimal_stock')])
            ->orderBy('P.stock', 'desc')
            ->get();
        
            $totalProfit = [
                'hariIni' => $totalProfitToday,
                'mingguIni' => $totalProfitWeek,
                'bulanIni' => $totalProfitMonth,
                'tahunIni' => $totalProfitYear,
                'history' => $history,
                'lowStock' => $lowStock,
            ];

            // dd($totalProfit);

            $outlet = Outlet::findOrFail($id);

            $admin = Admin::find(session()->get('auth_id'));

        return view('admin.crud-outlet.show', compact('totalItem', 'totalTransaksi', 'updateProduct', 'subtotalTransaksi', 'topProduct', 'totalProfit' ,'admin' ,'outlet' ));
    }

    public function showDetail($id)
    {
        $transactionData = Transaction::with('employee', 'employee.outlet')->find($id);
        $detailTransactionData = detail_transaction::with('product')->where('transaction_id', $id)->get();
        $admin = Admin::find(session()->get('auth_id'));
        return view('admin.crud-outlet.detail-trasaction', compact('transactionData', 'detailTransactionData', 'admin'));
    }

    public function resetProduct($id)
    {   
        DB::table('products as P')
        ->join('units as U', 'P.unit_id', '=', 'U.id')
        ->join('employees as E', 'P.employee_id', '=', 'E.id')
        ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
        ->where('O.id', $id)
        ->delete();

        return redirect()->back()->with('success', 'Berhasil mereset data produk ditoko ini');
    }

    public function resetTransaction()
    {   
        transaction::truncate();
        detail_transaction::truncate();
        return redirect()->back()->with('success', 'Berhasil mereset data transaksi ditoko ini');
    }

    public function resetCustomer($id)
    {   
        Customer::where('outlet_id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil mereset data pelanggan ditoko ini');
    }

}
