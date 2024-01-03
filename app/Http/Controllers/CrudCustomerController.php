<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CrudCustomerController extends Controller
{
    //halaman customer
    public function customer()
    {
        $data = customer::all();
        // dd($data);
        return view('employee.customer', compact('data'), ["title" => "Pelanggan"]);
    }


    //Tambah customer
    public function addcustomer()
    {
        return view('employee.crud-customer.add', ["title" => "Tambah Pelanggan"]);
    }

    public function newcustomer(Request $request)
    {
        // Mendapatkan data untuk pembuatan kode member
        $kodetokoName = 'PTB';
        $bulanTahun = now()->format('d m y');

        // Mendapatkan urutan terakhir
        $lastMember = customer::orderBy('id', 'desc')->first();
        $urutan = $lastMember ? intval(substr($lastMember->code, -2)) + 1 : 1;

        // Menghasilkan kode member yang unik
        $code = $kodetokoName . '_' . $bulanTahun . '_' . str_pad($urutan, 2, '0', STR_PAD_LEFT);

        // dd($request->all());
        customer::create($request->all());
        return redirect()->route('customer_page')->with('success', 'Data Berhasil Di Tambahkan');
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


    public function destroy(string $id)
    {
        //
    }
}
