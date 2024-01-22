<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;
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
            $price_sales = $request->grosir;
        } else {
            $discount = 0;
            $price_sales = 0;
        }

        if($qty > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah pembelian produk melebihi stok');
        }

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "id" =>$product->id,
            "name_product" => $product->name_product, 
            "image" => $product->image,
            "selling_price" => $product->selling_price,
            "selling_price_disc" => $selling_price,
            "price_sales" => $price_sales,
            "stock" => $product->stock,
            "qty" => $request->quantity,
            "discount" => $discount,
            "total_price" => $selling_price * $request->quantity,
        ];

        $subtotal = array_sum(array_column($cart, 'total_price'));

        $additional_cost = Session::get('additional_cost');

        if( session('additional_cost') || $additional_cost > 0){
            $subtotal += $additional_cost;
        }

        // dd($additional_cost);

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
            $subtotal = array_sum(array_column($cart, 'total_price'));

            $additional_cost = Session::get('additional_cost');

            if( session('additional_cost') || $additional_cost > 0){
                $subtotal += $additional_cost;
            }
    
            session()->put('cart', $cart);
            session()->put('subtotal', $subtotal);
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
            $cart[$id]['total_price'] = $cart[$id]['selling_price_disc'] * $qty;

            // dd( $cart[$id]['total_price']);
            if ($qty > $cart[$id]['stock']) {
                return redirect()->back()->with('error', 'Jumlah pembelian produk melebihi stok');
            }

            $subtotal = array_sum(array_column($cart, 'total_price'));

            $additional_cost = Session::get('additional_cost');

            if( session('additional_cost') || $additional_cost > 0){
                $subtotal += $additional_cost;
            }

            session()->put('cart', $cart);
            session()->put('subtotal', $subtotal);
        }

        return redirect()->back()->with('success', 'Berhasil memperbarui kuantitas produk');
    }

    public function reset()
    {
        session()->forget('cart');
        session()->forget('subtotal');
        session()->forget('no_ref');
        session()->forget('additional_cost');
        session()->forget('notes');
        session()->forget('pay');
        session()->forget('change');

        return redirect()->route('transaction')->with('success', 'Berhasil reset list pembelian produk');
    }
}
