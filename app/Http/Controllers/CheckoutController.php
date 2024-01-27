<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\detail_transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{   
    public function index()
    {
        $emp = Employee::find(session()->get('auth_id'));
        $outlet = outlet::find(session('outlet_id'));
        
        $today = Carbon::now();

        if (!session()->has('no_ref')) {
            $outletName = $outlet->name_outlet;
            $words = explode(' ', $outletName);
            $firstLetters = array_map(function ($word) {
                return strtoupper(substr($word, 0, 1));
            }, $words);
            $cdoutlet = implode('', $firstLetters);
            $get_milisecond = Carbon::now()->valueOf();
            $random = intval($get_milisecond . rand(1, 9999));
            $no_ref = $cdoutlet . $random;

            Session::put('no_ref', $no_ref);
        } else {
            $no_ref = session('no_ref');
        }
    
        return view('employee.checkout', compact('emp', 'outlet', 'no_ref', 'today'), ["title" => "Transaksi Checkout"]);
    }
    

    public function addCost(Request $request)
    {   
        $add = $request->additional_cost;

        Session::put('additional_cost', $add);

        $subtotal = Session::get('subtotal');
        $additional_cost = Session::get('additional_cost');
        
        $subtotal += $additional_cost;
        Session::put('subtotal', $subtotal);
        
        return redirect()->back()->with('success', 'Berhasil menambah biaya tambahan');
    }

    public function deleteAddCost()
    {   
        $subtotal = Session::get('subtotal');
        $additional_cost = Session::get('additional_cost');
        
        $subtotal -= $additional_cost;
        Session::put('subtotal', $subtotal);

        session()->forget('additional_cost');

        return redirect()->back()->with('success', 'Berhasil menghapus biaya tambahan');
    }
    
    public function notes(Request $request)
    {   
        $note = $request->note;
        
        Session::put('notes', $note);
        
        return redirect()->back()->with('success', 'Berhasil menambah catatan');
    }
    
    public function deleteNotes()
    {   
        session()->forget('notes');

        return redirect()->back()->with('success', 'Berhasil menghapus catatan');
    }

    public function cancelTransaction()
    {   

        session()->forget('cart');
        session()->forget('subtotal');
        session()->forget('no_ref');
        session()->forget('additional_cost');
        session()->forget('notes');
        session()->forget('pay');
        session()->forget('change');
        session()->forget('today');

        return redirect()->route('transaction')->with('success', 'Berhasil membatalkan pembelian');
    }

    public function pay(Request $request)
    {   
        DB::beginTransaction();

        try {
        $validatedData = $request->validate([
            'bayar' => 'required|numeric|gt:0',
        ]);
            
        $pay = $validatedData['bayar'];
        $change = $request->kembali;

        if (!session()->has('today')) {
            $today = Carbon::now();

            Session::put('today', $today);
        } else {
            $today = session('today');
        }

        $emp = Employee::find(session()->get('auth_id'));
        
        $subtotal = Session::get('subtotal');
        
        if ($pay < $subtotal) {
            throw new \Exception('Jumlah yang dibayarkan kurang dari total pembayaran');
        }

        $change = $pay - $subtotal;

        Session::put('pay', $pay);
        Session::put('change', $change);

        $kode_invoice = session('no_ref');
        $additional_cost = session('additional_cost');
        $note = session('notes');
        $pay = session('pay');
        $change = session('change');
        $today = session('today');

        $data_transaction = [
            'employee_id' => $emp->id,
            'kode_invoice' => $kode_invoice,
            'additional_cost' => $additional_cost,
            'subtotal' => $subtotal,
            'note' => $note,
            'pay' => $pay,
            'change' => $change,
            'created_at' => $today,
        ];

        $transaction = Transaction::create($data_transaction);
        $transaction_id = $transaction->id;

        $cart = session('cart');

        if (count($cart) > 0) {
            foreach (session('cart') as $cartItem) {
                $dt_transaction_list = [
                    'transaction_id' => $transaction_id,
                    'product_id' => $cartItem['id'],
                    'qty' => $cartItem['qty'],
                    'price_sales' => $cartItem['price_sales'],
                    'discount' => $cartItem['discount'] * $cartItem['qty'],
                    'total_price' => $cartItem['total_price'],
                ];

                Detail_Transaction::create($dt_transaction_list);
                
                $product = Product::find($cartItem['id']);
                $product->stock -= $cartItem['qty'];
                $product->save();
            }
        } else {
            throw new \Exception('Pembelian gagal, coba lagi dengan menekan tombol batal');
        }

        // Commit transaksi jika semuanya berhasil
        DB::commit();

        return redirect()->back()->with('success', 'Pembelian berhasil');
    } catch (\Exception $e) {
        // Rollback transaksi jika ada kesalahan
        DB::rollback();

        return redirect()->back()->with('error', 'Pembelian gagal: ' . $e->getMessage());
    }
    }

    public function cetak_pdf()
    {
        $outlet = outlet::find(session('outlet_id'));
        $today = Carbon::now();
    	$emp = Employee::find(session()->get('auth_id'));
        $details = ['title' => 'checkoutPDF']; 

        //dd($data['emp']['name_employee']);
        view()->share('outlet', $outlet);
        view()->share(['today'=>$today]);
        view()->share(['emp'=>$emp]);
        view()->share(['details'=>$details]);   
        // return view ('employee.transaction.export-pdf');
        $fileName = 'checkout ref -' . Str::slug(session('no_ref')) . ' - ' . $today->format('d M Y') . '.pdf';
        $pdf = PDF::loadview('employee.transaction.export-pdf', $details)->setPaper([0, 0, 226.77, 1000], 'portrait')->setWarnings(false)->save($fileName);
        return $pdf->download($fileName);
    }

    public function finish()
    {   
        session()->forget('cart');
        session()->forget('subtotal');
        session()->forget('no_ref');
        session()->forget('additional_cost');
        session()->forget('notes');
        session()->forget('pay');
        session()->forget('change');
        session()->forget('today');

        return redirect()->route('transaction');
    }
}
