<?php

namespace App\Http\Controllers;

use App\Models\detail_transaction;
use App\Models\Employee;
use App\Models\outlet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function history()
    {
        $emp = Employee::find(session()->get('auth_id'));

        $transaction = Transaction::orderBy('created_at', 'DESC')->get();
        return view('employee.history-transaction.history-transaction', compact('emp', 'transaction'), ["title" => "Riwayat Penjualan"]);
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
        $outlet = outlet::find(session('outlet_id'));
        $emp = Employee::find(session()->get('auth_id'));
        $transactionData = Transaction::with('employee')->find($id);
        $detailTransactionData = detail_transaction::with('product')->where('transaction_id', $id)->get();
        // dd( $transactionData['no_ref'] );
        return view('employee.history-transaction.detail-trasaction', compact('transactionData', 'detailTransactionData', 'emp', 'outlet'), ["title" => "Detail Transaksi"]);
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
