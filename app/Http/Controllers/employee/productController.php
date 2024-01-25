<?php

namespace App\Http\Controllers\employee;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\outlet;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\productExport;
use App\Imports\ProductImport;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.minimal_stock', 'P.selling_price', 'P.buy_price', 'U.satuan as satuan_product', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
            ->where('O.id', $outletId)
            ->orderBy('P.created_at', 'desc')
            ->get();

        $totalLowStock = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

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
            'stock' => 'required|numeric',
            'minimal_stock' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
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
            'minimal_stock' => $validate['minimal_stock'],
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
        return view('employee.crud-product.edit', compact('emp', 'product', 'unit'), ["title" => "Edit Produk"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_product' => 'required',
            'unit_id' => 'required',
            'stock' => 'required|numeric',
            'minimal_stock' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'desc' => 'nullable',
            'image' => 'nullable|image|file|max:2500',
        ]);

        $product = [
            'name_product' => ucwords($validate['name_product']),
            'unit_id' => $validate['unit_id'],
            'stock' => $validate['stock'],
            'minimal_stock' => $validate['minimal_stock'],
            'buy_price' => $validate['buy_price'],
            'selling_price' => $validate['selling_price'],
            'desc' => $validate['desc'],
        ];

        // Cek apakah file gambar diunggah
        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // Simpan gambar yang baru diunggah
            $product['image'] = $request->file('image')->store('product_images');
        }

        Product::findOrFail($id)->update($product);
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

    public function restock()
    {
        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $product = DB::table('products as P')
            ->join('units as U', 'P.unit_id', '=', 'U.id')
            ->join('employees as E', 'P.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('P.id', 'P.barcode', 'P.name_product', 'P.stock', 'P.minimal_stock', 'U.satuan as satuan_product', 'P.buy_price', 'P.selling_price')
            ->where('O.id', $outletId)
            ->whereBetween('P.stock', [0, DB::raw('P.minimal_stock')])
            ->orderBy('P.stock', 'desc')
            ->get();

        return view('employee.crud-product.restock', compact('emp', 'product'), ["title" => "Restok Produk"]);
    }

    public function restockproduct(Request $request, string $id)
    {
        $product = Product::find($id);
        $additionalStock = $request->restock;
        $product->stock += $additionalStock;
        $product->save();

        return redirect()->route('product.restock')->with('success', 'Stok produk berhasil ditambahkan');
    }

    public function updatestock(string $id)
    {
        $product = Product::findOrFail($id);
        $emp = Employee::find(session()->get('auth_id'));
        return view('employee.crud-product.updatestock', compact('emp', 'product'), ["title" => "Restok Produk"]);
    }

    public function editstock(Request $request, string $id)
    {
        $product = Product::find($id);
        $additionalStock = $request->restock;
        $product->stock += $additionalStock;
        $product->save();

        return redirect()->route('product')->with('success', 'Stok produk berhasil ditambahkan');
    }

    public function exportPDF()
    {
        // $product = Product::all();
        $outlet = outlet::find(session('outlet_id'));
        $product = Product::join('units as U', 'products.unit_id', '=', 'U.id')
            ->join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->select('products.id', 'products.barcode', 'products.name_product', 'products.stock', 'products.selling_price', 'products.buy_price', 'U.satuan as satuan_product', 'E.name_employee as employee_name', 'O.name_outlet as outlet_name')
            ->where('O.id', $outlet->id)
            ->orderBy('products.created_at', 'desc')
            ->get();

        $total = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->selectRaw('COUNT(products.id) as totalProduct')
            ->where('O.id', $outlet->id)
            ->first();

        $today = Carbon::now();
        view()->share('product', $product);
        view()->share('outlet', $outlet);
        view()->share('today', $today);
        view()->share('total', $total->totalProduct);
        $pdf = PDF::loadview('employee.export.export-pdf', ['title' => 'printPDF']);
        $fileName = 'data toko ' . Str::slug($outlet->name_outlet) . ' ' . $today->format('d M Y') . '.pdf';
        return $pdf->download($fileName);
        PDF::loadView($pdf)->setPaper('a4', 'landscape')->setWarnings(false)->save($fileName);
    }

    public function exportEXCEL()
    {
        return Excel::download(new productExport, 'data produk toko bangunan.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // menangkap file excel
        $data = $request->file('file');
        // membuat nama file unik
        $nama_file = rand() . $data->getClientOriginalName();
        // upload ke folder file_siswa di dalam folder public
        $data->move('file_produk', $nama_file);
        // import data
        Excel::import(new ProductImport, \public_path('/file_produk/' . $nama_file));

        return redirect()->back()->with('success', 'Data berhasil diImport');
    }

    public function model(array $row)
    {
        $validator = Validator::make(['image' => $row[8]], [
            'image' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        if ($validator->fails()) {
            // Handle validasi gagal, misalnya lempar exception atau lakukan sesuatu yang sesuai
            // ...

            // Jangan lanjutkan proses pembuatan model jika validasi gagal
            return null;
        }
    }
}
