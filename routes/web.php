<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('employee.login' , [ "title" => "Login Employee"]);
});

Route::get('/loginadmin', function () {
    return view('admin.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

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