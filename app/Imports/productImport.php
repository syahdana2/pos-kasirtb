<?php

namespace App\Imports;

use App\Models\product;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class productImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make([
            'name_product' => $row[2],
        ], [
            'name_product' => 'required',
            'image' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);
    
        if ($validator->fails()) {
            // Handle validasi gagal, misalnya lempar exception atau lakukan sesuatu yang sesuai
            session()->flash('import_error', 'Ada kesalahan pada file Excel Anda: ' . $validator->errors()->first());
    
            // Jangan lanjutkan proses pembuatan model jika validasi gagal
            return null;
        }
        
        $emp = Employee::find(session()->get('auth_id'));

        $productInstance = new product([
           'employee_id' => $emp->id,
           'name_product' => $row[2],
           'barcode' => $row[3],
           'unit_id' => $row[4],
           'stock' => $row[5],
           'minimal_stock' => $row[6],
           'buy_price' => $row[7],
           'selling_price' => $row[8],
           'image' => $row[9] ?? null,
           'desc' => $row[10] ?? null,
        ]);

        return $productInstance;
    }
}
