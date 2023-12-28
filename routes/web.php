<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\loginadminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\logoutController;

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
Route::post('/loginadmin', [authController::class,'login_Admin'])->name('admin.login');

Route::get('/', function () {
    return view('employee.login');
})->name('employee.login');
Route::post('/', [authController::class, 'login_employee'], {{ $title }})->name('employee.login');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/logout', [authController::class,'logout'])->name('admin.logout');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // tambahkan route untuk akses halaman admin
});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/logoutemployee', [authController::class,'logout_employee'])->name('employee.logout');
    // tambahakan route untuk akses halaman employee
    Route::get('/dashboardemployee', function () {
    return view('employee.dashboardemployee', [ "title" => "Dashboard Employee"]);
});

Route::get('/transaksi', function () {
    return view('employee.transaction' , [ "title" => "Transaksi"]);
});

Route::get('/pelanggan', function () {
    return view('employee.customer' , [ "title" => "Pelanggan"]);
});

Route::get('/data-produk', function () {
    return view('employee.data-product' , [ "title" => "Data Produk"]);
});

Route::get('/riwayat-penjualan', function () {
    return view('employee.history-transaction.history-selling' , [ "title" => "Riwayat Penjualan"]);
});

Route::get('/member', function () {
    return view('employee.crud-produk.create');
});
});
