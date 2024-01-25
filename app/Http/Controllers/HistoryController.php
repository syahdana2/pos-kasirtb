<?php

namespace App\Http\Controllers;

use App\Models\detail_transaction;
use App\Models\Employee;
use App\Models\outlet;
use App\Models\product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function history()
    {
        $outletId = session('outlet_id');

        $emp = Employee::find(session()->get('auth_id'));

        $totalLowStock = product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

            $transactions = DB::table('transactions as T')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('T.id', 'T.kode_invoice', 'T.additional_cost', 'T.subtotal', 'T.note', 'T.pay', 'T.change', 'T.created_at', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
            ->where('O.id', $outletId)
            ->whereDate('T.created_at', today())
            ->orderBy('T.created_at', 'desc')
            ->get();

            foreach ($transactions as $transaction) {
                $detailTransactions = detail_transaction::where('transaction_id', $transaction->id)->get();
                $totalProfit = 0;
            
                foreach ($detailTransactions as $detailTransaction) {
                    $sellingPrice = ($detailTransaction->price_sales) ? $detailTransaction->price_sales : $detailTransaction->product->selling_price;
                    $buyingPrice = $detailTransaction->product->buy_price;
                    $quantity = $detailTransaction->qty;
                    $profit = ($sellingPrice - $buyingPrice) * $quantity;
                    $totalProfit += $profit;
                }
            
                // Menambahkan profit ke dalam objek transaksi
                $transaction->profit = $totalProfit;
            }

        return view('employee.history-transaction.history-transaction', compact('emp', 'transactions', 'totalLowStock'), ["title" => "Riwayat Penjualan"]);
    }

    public function show(string $id)
    {
        $outlet = outlet::find(session('outlet_id'));
        $emp = Employee::find(session()->get('auth_id'));
        $transactionData = Transaction::with('employee')->find($id);
        $detailTransactionData = detail_transaction::with('product')->where('transaction_id', $id)->get();
        return view('employee.history-transaction.detail-trasaction', compact('transactionData', 'detailTransactionData', 'emp', 'outlet'), ["title" => "Detail Transaksi"]);
    }
}
