<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\outlet;
use App\Models\product;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
            ->join('detail_transactions as DT', 'DT.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('T.id', 'T.kode_invoice', 'T.additional_cost', 'T.subtotal', 'T.note', 'T.pay', 'T.change', 'T.created_at', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name', 'DT.profit as labaProfit')
            ->where('O.id', $outletId)
            ->orderBy('T.created_at', 'desc')
            ->get();

            foreach ($transactions as $transaction) {
                $detailTransactions = detail_transaction::where('transaction_id', $transaction->id)->get();
                $totalProfit = 0;
            
                // foreach ($detailTransactions as $detailTransaction) {
                //     $sellingPrice = ($detailTransaction->price_sales) ? $detailTransaction->price_sales : $detailTransaction->product->selling_price;
                //     $buyingPrice = $detailTransaction->product->buy_price;
                //     $quantity = $detailTransaction->qty;
                //     $profit = ($sellingPrice - $buyingPrice) * $quantity;
                //     $totalProfit += $profit;
                // }

                foreach ($detailTransactions as $detailTransaction) {
                    // Pastikan produk masih ada sebelum mencoba mengakses atributnya
                    if ($detailTransaction->product) {
                        $sellingPrice = ($detailTransaction->price_sales) ? $detailTransaction->price_sales : $detailTransaction->product->selling_price;
                        $buyingPrice = $detailTransaction->product->buy_price;
                        $quantity = $detailTransaction->qty;
                        $profit = ($sellingPrice - $buyingPrice) * $quantity;
                        $totalProfit += $profit;
                    } else {
                        $sellingPrice = $detailTransaction->price_sales;
                        $buyingPrice = $detailTransaction->price_sales;
                        $quantity = $detailTransaction->qty;
                        $profit = ($sellingPrice - $buyingPrice) * $quantity;
                        $totalProfit += $profit;
                    }
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

    public function searchByDate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // dd($endDate);

        // Fetch transactions based on the date range
        $transactions = $this->getTransactionsByDateRange($startDate, $endDate);

        // Calculate total subtotal and total profit
        $totalSubtotal = $transactions->sum('subtotal');
        $totalProfit = $transactions->sum('profit');

        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $totalLowStock = product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

        return view('employee.history-transaction.history-transaction', compact('emp', 'transactions', 'totalLowStock', 'totalSubtotal', 'totalProfit'), ["title" => "Riwayat Penjualan"]);
    }

    private function getTransactionsByDateRange($startDate, $endDate)
    {
        $outletId = session('outlet_id');

        $transactions = DB::table('transactions as T')
            ->join('detail_transactions as DT', 'DT.transaction_id', '=', 'T.id')
            ->join('employees as E', 'T.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('T.id', 'T.kode_invoice', 'T.additional_cost', 'T.subtotal', 'T.note', 'T.pay', 'T.change', 'T.created_at', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name', 'DT.profit as labaProfit')
            ->where('O.id', $outletId)
            ->whereBetween('T.created_at', [$startDate, $endDate])
            ->orderBy('T.created_at', 'desc')
            ->get();

        return $transactions;
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            $transaction->detailTransactions()->delete();

            $transaction->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus riwayat pembelian');
        }

        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    public function returnTransaction(string $id)
    {
        $id = product::findOrFail($id);

        return view('employee.transaction');
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
