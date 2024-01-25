<?php

namespace App\Imports;

use App\Models\unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UnitImport implements ToModel
{
    /**
    * @param Collection $collection
    */

    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row) {
    //         $detail = unit::find($row['satuan']);
    //         $detail->field_to_update = $row[2];
    //         $detail->save();
    //     }
    // }

    // public function model(array $row){
    //     // dd($row);
    //     return new UnitImport([
    //         'satuan' => $row[1 ],
    //     ]);
    //     // foreach ($rows as $row) {
    //     //     // dd($row->unit->satuan);
    //     //     $detail = unit::findOrFail($row['satuan']);
    //     //     $detail->field_to_update = $row['satuan'];
    //     //     $detail->save();
    //     // }
    // }
    
    public function model(array $row)
    {
        // $existingUnit = Unit::where('satuan', $row[2])->first();
        // if ($existingUnit) {
        //     // Satuan sudah terdaftar, beri pesan error dan hentikan proses
        //     return redirect()->route('unit_page')->with('gagal','Satuan "' . $row[2] . '" sudah terdaftar.');
        // }

        return new unit([
            'satuan' => $row[1],
        ]);
    }
}
