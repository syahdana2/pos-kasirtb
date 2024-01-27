<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\outlet;
use App\Models\product;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\detail_transaction;
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

    public function exportPDF($id)
    {
        $transactionData = Transaction::with('employee')->find($id);
        $detailTransactionData = detail_transaction::with('product')->where('transaction_id', $id)->get();
        $outlet = outlet::find(session('outlet_id'));
        $today = Carbon::now();
        $details = ['title' => 'Nota-PDF'];
// dd($emp->name_employee);
        
        //return view ('employee.transaction.export-pdf', compact('data'));
        //dd($data['emp']['name_employee']);
        view()->share('detailTransactionData', $detailTransactionData);
        view()->share('transactionData', $transactionData);
        view()->share('outlet', $outlet);
        view()->share('today', $today);
        //return view('employee.history-transaction.export-pdf' );
        $fileName = 'struk ref -' . Str::slug($transactionData->kode_invoice) . ' - ' . $today->format('d M Y') . '.pdf';
        $pdf = PDF::loadview('employee.history-transaction.export-pdf', $details)->setPaper([0, 0, 226.77, 1000], 'potrait')->setWarnings(false)->save($fileName);;
        return $pdf->download($fileName);
    }
}
