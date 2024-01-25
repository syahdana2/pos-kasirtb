<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\outlet;
use App\Models\product;
use Maatwebsite\Excel\Concerns\FromCollection;

class productExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return product::all();
        outlet::find(session('outlet_id'));
        Carbon::now()->format('d M Y');
    }
}
