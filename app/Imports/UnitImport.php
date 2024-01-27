<?php

namespace App\Imports;

use App\Models\unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UnitImport implements ToModel
{
    /**
    * @param Collection $collection
    */

    // use Importable;

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
        //dd($row)
        return new unit([
            'satuan' => $row[1],
            //'satuan'  => $row['satuan'],
        ]);
    }
}
