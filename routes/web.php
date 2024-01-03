<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\loginadminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\CrudCustomerController;
use App\Http\Controllers\CrudHistoryController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/loginadmin', function () {
    return view('admin.login');
});
Route::post('/loginadmin', [authController::class, 'login_Admin'])->name('admin.login');

Route::get('/', function () {
    return view('employee.login');
})->name('employee.login');
Route::post('/', [authController::class, 'login_employee'])->name('employee.login');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/logout', [authController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // tambahkan route untuk akses halaman admin
});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/logoutemployee', [authController::class, 'logout_employee'])->name('employee.logout');
    // tambahakan route untuk akses halaman employee

    Route::get('/dashboard-employee', [DashboardController::class, 'dashboard'])->name('employee.dashboard');

    Route::get('/transaksi', [TransactionController::class, 'transaction']);

    // Route pelanggan
    Route::get('/pelanggan', [CrudCustomerController::class, 'customer'])->name('customer_page');
    Route::get('/tambah-pelanggan', [CrudCustomerController::class, 'addcustomer'])->name('add_customer');
    Route::post('/buat-pelanggan-baru', [CrudCustomerController::class, 'newcustomer']);
    Route::get('/edit-pelanggan/{id}', [CrudCustomerController::class, 'datacustomer'])->name('data_customer');
    Route::post('/update-pelanggan/{id}', [CrudCustomerController::class, 'updatecustomer'])->name('update_customer');
    Route::get('/hapus-pelanggan/{id}', [CrudCustomerController::class, 'deletecustomer'])->name('delete_customer');

    //Route Product
    Route::get('/data-produk', [CrudProductController::class, 'product']);

    Route::get('/riwayat-penjualan', [HistoryController::class, 'history']);
});
