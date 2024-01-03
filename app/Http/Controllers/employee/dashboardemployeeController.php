<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Product;

class dashboardemployeeController extends Controller
{
    public function index () {
        $emp = Employee::find(session()->get('auth_id'));

        $outletId = session('outlet_id');

        $lowStockSum = DB::table('products as P')
        ->join('employees as E', 'P.employee_id', '=', 'E.id')
        ->join('outlets as O', 'E.outlet_id', '=', 'O.id')
        ->select(DB::raw('SUM(P.stock) as totalLowStock'))
        ->where('O.id', $outletId)
        ->where('P.stock', '<', 5)
        ->first();

        // Mengakses hasil query
        $totalLowStock = $lowStockSum->totalLowStock;

        // $lowStockProducts = Product::where('stock', '<', 5)->get();
        return view('employee.dashboardemployee', compact('emp', 'totalLowStock'), ["title" => "Dashboard Employee"]);
    }
}
