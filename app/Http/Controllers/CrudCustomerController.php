<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use App\Models\customer;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudCustomerController extends Controller
{
    //halaman customer
    public function customer()
    {
        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $totalLowStock = Product::join('employees as E', 'products.employee_id', '=', 'E.id')
            ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->whereBetween('products.stock', [0, DB::raw('products.minimal_stock')])
            ->count();

        $data = customer::join('outlets as O', 'customers.outlet_id', '=', 'O.id')
            ->where('O.id', $outletId)
            ->orderBy('customers.created_at', 'desc')
            ->get();
        // dd($data);
        return view('employee.customer', compact('data', 'emp', 'totalLowStock'), ["title" => "Pelanggan"]);
    }


    //Tambah customer
    public function addcustomer()
    {
        return view('employee.crud-customer.add', ["title" => "Tambah Pelanggan"]);
    }

    public function newcustomer(Request $request)
    {

        $validator = $request->validate([
            'name' => ['required'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'note' => ['nullable']

        ]);

        // Membuat kode nama toko dari huruf awalnya
        function getAbbreviation($string)
        {
            $words = explode(' ', $string);
            $abbreviation = '';

            foreach ($words as $word) {
                $abbreviation .= strtoupper(substr($word, 0, 1));
            }

            return $abbreviation;
        }

        // Mendapatkan data untuk pembuatan kode member
        $dtout = outlet::find(session('outlet_id'));
        $kodetokoName = getAbbreviation($dtout->name_outlet, 0, 3);

        $bulanTahun = now()->format('dm');

        // Mendapatkan urutan terakhir
        $lastMember = customer::orderBy('id', 'desc')->first();
        $urutan = $lastMember ? intval(substr($lastMember->code, -2)) + 1 : 1;

        // Menghasilkan kode member yang unik
        $code = $kodetokoName . '_' . $bulanTahun . '_' . str_pad($urutan, 2, '0', STR_PAD_LEFT);

        // dd($request->all());
        $outletId = session('outlet_id');

        $data = [
            "outlet_id" => $outletId,
            "code" => $code,
            "name" => $validator['name'],
            "phone" => $validator['phone'],
            "address" => $validator['address'],
            "note" => $validator['note'],
        ];

        customer::create($data);
        return redirect()->route('customer_page', compact('code'))->with('success', 'Data Berhasil Di Tambahkan');
    }


    //Edit customer
    public function datacustomer($id)
    {
        $data = customer::find($id);
        // dd($data);
        return view('employee.crud-customer.editdata', ["title" => "Edit Pelanggan"], compact('data'));
    }

    public function updatecustomer(Request $request, $id)
    {
        $data = customer::find($id);
        $data->update($request->all());
        return redirect()->route('customer_page')->with('success', 'Data Berhasil Di Update');
    }


    //Hapus customer
    public function deletecustomer($id)
    {
        $data = customer::find($id);
        $data->delete();
        return redirect()->route('customer_page')->with('success', 'Data Berhasil Di Hapus');
    }

    public function show(string $id)
    {
        $customer = customer::findOrFail($id);
        $emp = Employee::find(session()->get('auth_id'));
        return view('employee.crud-customer.show', compact('customer', 'emp'), ["title" => "Detail Pelanggan"]);
    }
}
