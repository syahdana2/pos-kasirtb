<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\unit;
use App\Models\outlet;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnitExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return unit::all();
        outlet::find(session('outlet_id'));
        Carbon::now()->format('d M Y');
    }
}
