<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\detail_transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transaction()
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

        // Mengakses hasil query
        $totalLowStock = $lowStockSum->totalLowStock;

        $product = DB::table('products as P')
        ->join('units as U', 'P.unit_id', '=', 'U.id')
        ->join('employees as E', 'P.employee_id', '=', 'E.id')
        ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
        ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.selling_price', 'P.buy_price', 'U.satuan as satuan_product', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
        ->where('O.id', $outletId)
        ->where('P.stock', '>', 0)
        ->orderBy('P.created_at', 'desc')
        ->get();

        // dd(session('cart'));

        return view('employee.transaction', compact('emp', 'totalLowStock', 'product'), ["title" => "Transaksi"]);
    }

    public function cart(Request $request, $id){
        // dd($request);
        $product = product::findOrFail($id);
        $qty = $request->quantity;
        $grosir = $request->grosir;

        if ($grosir < 0 || $grosir > $product->selling_price) {
            return redirect()->back()->with('error', 'harga grosir melebihi harga jual produk');
        }

        $selling_price = $grosir > 0 ? $grosir : $product->selling_price;

        if ($grosir > 0){
            $discount = $product->selling_price - $grosir;
        } else {
            $discount = 0;
        }

        if($qty > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah pembelian produk melebihi stok');
        }

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "id" =>$product->id,
            "name_product" => $product->name_product, 
            "image" => $product->image,
            // "harga_asli" => $product->selling_price,
            "selling_price" => $product->selling_price,
            "selling_price_disc" => $selling_price,
            "stock" => $product->stock,
            "qty" => $request->quantity,
            "discount" => $discount,
            "total_price" => $selling_price * $request->quantity,
        ];

        $subtotal = array_sum(array_column($cart, 'total_price'));

        session()->put('cart', $cart);
        session()->put('subtotal', $subtotal);

        // dd(session('subtotal'));

        return redirect()->back()->with('success', 'berhasil menambah produk ke keranjang');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('transaction')->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function updateQty(Request $request, $id)
    {   
        $cart = session()->get('cart', []);
        // dd($cart);

        if (isset($cart[$id])) {
            $qty = max(1, $request->input('qty'));

            $cart[$id]['qty'] = $qty;

            // dd( $cart[$id]['stock']);
            if ($qty > $cart[$id]['stock']) {
                return redirect()->back()->with('error', 'Jumlah pembelian produk melebihi stok');
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Berhasil memperbarui kuantitas produk');
    }

    public function reset()
    {
        session()->forget('cart');

        return redirect()->route('transaction')->with('success', 'Berhasil reset list pembelian produk');
    }

    public function checkout(Request $request)
    {   
        $emp = Employee::find(session()->get('auth_id'));

        $outlet = outlet::find(session('outlet_id'));
        
        $add = $request->additional_cost;
        $note = $request->note;

        Session::put('additional_cost', $add);
        Session::put('notes', $note);

        // kode outlet
        $outlet = outlet::find(session('outlet_id'));
        $outletName = $outlet->name_outlet;
        $words = explode(' ', $outletName);
        $firstLetters = array_map(function ($word) {
            return strtoupper(substr($word, 0, 1));
        }, $words);
        $cdoutlet = implode('', $firstLetters);
        // kode mmilisecond
        $get_milisecond = Carbon::now()->valueOf();
        $random = intval($get_milisecond.rand(1,9999));
        $no_ref = $cdoutlet . $random;

        $today = Carbon::now();

        $cart = session()->get('cart');

        foreach ($cart as $prodcut){

        }

        // dd($prodcut['name_product']);
        
        return view('employee.checkout',compact('emp', 'outlet', 'today'), ["title" => "Transaksi Checkout"]);
    }

    public function addCost(Request $request)
    {
        $cutPrice = $request->input('cut_price');
        $additionalCost = $request->input('additional_cost');
        $notes = $request->input('note');

        // Dapatkan session cart
        $cart = Session::get('cart', []);

        // Hitung total baru
        $totalCart = 0;
        foreach ($cart as $item) {
            $totalCart += $item['qty'] * $item['selling_price'];
        }

        // Tambahkan biaya potongan dan biaya tambahan
        $totalCart -= $cutPrice;
        $totalCart += $additionalCost;

        // Simpan biaya potongan, biaya tambahan, dan catatan ke dalam session
        Session::put('cut_price', $cutPrice);
        Session::put('additional_cost', $additionalCost);
        Session::put('notes', $notes);

        // Redirect kembali ke halaman checkout
        return redirect()->route('checkout')->with('success', 'Biaya potongan dan biaya tambahan berhasil ditambahkan');
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
        detail_transaction::create([
            
        ]);
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
