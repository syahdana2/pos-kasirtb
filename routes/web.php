<?php

use App\Http\Controllers\admin\dashboardadminController;
use App\Http\Controllers\admin\outletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\employee\dashboardemployeeController;
use App\Http\Controllers\employee\productController;
use App\Http\Controllers\outletController as ControllersOutletController;

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
Route::post('/', [authController::class, 'login_employee'],)->name('employee.login');

Route::middleware(['admin.auth'])->group(function () {
    // tambahkan route untuk akses halaman admin
    Route::get('/logout', [authController::class, 'logout'])->name('admin.logout');
    Route::prefix('/admin')->group(function () {
        // route admin
        Route::get('/', [dashboardadminController::class, 'index'])->name('admin.dashboard');
        // route outlet
        Route::prefix('/outlet')->group(function () {
            Route::get('/', [OutletController::class, 'index'])->name('outlet');
            Route::get('/create', [OutletController::class, 'create'])->name('outlet.create');
            Route::post('/store', [OutletController::class, 'store'])->name('outlet.store');
            Route::get('/edit/{id}', [OutletController::class, 'edit'])->name('outlet.edit');
            Route::put('/update/{id}', [OutletController::class, 'update'])->name('outlet.update');
            Route::delete('/delete/{id}', [OutletController::class, 'destroy'])->name('outlet.destroy');
        });
        // route employee
        Route::prefix('/employee')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employee');
            Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
            Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        });
    });
});

Route::middleware(['employee.auth'])->group(function () {
    Route::get('/logoutemployee', [authController::class, 'logout_employee'])->name('employee.logout');
    // tambahakan route untuk akses halaman employee
    Route::get('/dashboardemployee', [dashboardemployeeController::class, 'index'])->name('employee.dashboard');

    Route::get('/transaksi', function () {
        return view('employee.transaction', ["title" => "Transaksi"]);
    });

    Route::get('/pelanggan', function () {
        return view('employee.customer', ["title" => "Pelanggan"]);
    });
    // Route product
    Route::prefix('/data-produk')->group(function () {
        Route::get('/', [productController::class, 'index'])->name('product');              
        Route::get('/create', [productController::class, 'create'])->name('product.create');              
        Route::post('/store', [productController::class, 'store'])->name('product.store');        
        Route::get('/show/{id}', [productController::class, 'show'])->name('product.show');              
        Route::get('/edit/{id}', [productController::class, 'edit'])->name('product.edit');
        Route::put('/update/{id}', [productController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [productController::class, 'destroy'])->name('product.destroy'); 
    });

    Route::get('/riwayat-penjualan', function () {
        return view('employee.history-transaction.history-selling', ["title" => "Riwayat Penjualan"]);
    });

    Route::get('/member', function () {
        return view('employee.crud-produk.create');
    });
});
