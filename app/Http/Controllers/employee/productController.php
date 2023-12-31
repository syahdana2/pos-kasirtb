<?php

namespace App\Http\Controllers\employee;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $outletId = session('outlet_id');

        $product = DB::table('products as P')
            ->join('units as U', 'P.unit_id', '=', 'U.id')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.selling_price', 'P.buy_price', 'U.satuan as satuan_product', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
            ->where('O.id', $outletId)
            ->orderBy('P.created_at', 'desc')
            ->get();

            // $dt_employee = Employee::orderBy('created_at', 'DESC')->get();

        $lowStockSum = DB::table('products as P')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select(DB::raw('COUNT(P.stock) as totalLowStock'))
            ->where('O.id', $outletId)
            ->where('P.stock', '<', 5)
            ->first();

        // Mengakses hasil query
        $totalLowStock = $lowStockSum->totalLowStock;

        $emp = Employee::find(session()->get('auth_id'));

        return view('employee.data-product', compact('product', 'totalLowStock', 'emp'), ["title" => "Data Produk"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $unit = Unit::all();
        $emp = Employee::find(session()->get('auth_id'));
        return view('employee.crud-product.create', compact('unit', 'emp'), ["title" => "Tambah Produk"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validate = $request->validate([
            'name_product' => 'required',
            'unit_id' => 'required',
            'stock' => 'required',
            'buy_price' => 'required',
            'selling_price' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable|image|file|max:2500',

        ]);

        // kode uniq
        $product = $request['name_product'];
        $words = explode(' ', $product);
        $firstLetters = array_map(function ($word) {
            return strtoupper(substr($word, 0, 1));
        }, $words);
        $cdproduct = implode('', $firstLetters);

        $time = Carbon::now()->format('is');

        $outlet = outlet::find(session('outlet_id'));
        $outletName = $outlet->name_outlet;
        $words = explode(' ', $outletName);
        $firstLetters = array_map(function ($word) {
            return strtoupper(substr($word, 0, 1));
        }, $words);
        $cdoutlet = implode('', $firstLetters);

        $randomNumber = rand(1000, 9999);
    
        $barcode = $cdproduct . $time . $cdoutlet . $randomNumber;

        $dtemp = Employee::find(session('auth_id'));
        $emp = $dtemp->id;

        $validate['image'] = null;

        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store('product_images');
        }

        $product = [
            'employee_id' => $emp,
            'name_product' => ucwords($validate['name_product']),
            'barcode' => $barcode,
            'unit_id' => $validate['unit_id'],
            'stock' => $validate['stock'],
            'buy_price' => $validate['buy_price'],
            'selling_price' => $validate['selling_price'],
            'desc' => $validate['desc'],
            'image' => $validate['image'],
        ];

        // dd($product);

        Product::create($product);
        return redirect()->route('product')->with('success', 'Data Produk Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $employee = Employee::all();
        $emp = Employee::find(session()->get('auth_id'));
        return view('employee.crud-product.show', compact('product', 'employee', 'emp'), ["title" => "Detail Produk"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $emp = Employee::find(session()->get('auth_id'));
        $product = Product::findOrFail($id);
        $unit = Unit::all();
        return view('employee.crud-product.edit', compact('emp', 'product', 'unit') ,["title" => "Edit Produk"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_product' => 'required',
            'unit_id' => 'required',
            'stock' => 'required',
            'buy_price' => 'required',
            'selling_price' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable|image|file|max:2500',

        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validate['image'] = $request->file('image')->store('product_images');
        }

        Product::findOrFail($id)->update($validate);
        return redirect()->route('product')->with('success', 'Produk berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        
        return redirect()->route('product')->with('success', 'Produk berhasil dihapus');
    }
}
