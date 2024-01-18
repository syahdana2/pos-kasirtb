<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CrudHistoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\admin\outletController;
use App\Http\Controllers\CrudCustomerController;
use App\Http\Controllers\employee\UnitController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\employee\productController;
use App\Http\Controllers\admin\dashboardadminController;

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
});
Route::post('/', [authController::class, 'login_employee'])->name('employee.login');

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
    Route::prefix('/employee')->group(function () {
        // Route Dashboard Employee
        Route::get('/dashboard-employee', [DashboardController::class, 'dashboard'])->name('employee.dashboard');
        // Route Transaksi
        Route::prefix('/transaksi')->group(function () {
            Route::get('/', [TransactionController::class, 'transaction'])->name('transaction');
            Route::post('cart/add/{id}', [TransactionController::class, 'cart'])->name('cart.add');
            Route::delete('cart/remove/{id}', [TransactionController::class, 'removeFromCart'])->name('cart.remove');
            Route::patch('cart/update/{id}', [TransactionController::class, 'updateQty'])->name('cart.update');
            Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
            Route::post('/addcost', [TransactionController::class, 'addCost'])->name('add.cost');
            Route::get('/reset-keranjang', [TransactionController::class, 'reset'])->name('reset.cart');
        });

        // Route Pelanggan
        Route::prefix('/pelanggan')->group(function () {
            Route::get('/', [CrudCustomerController::class, 'customer'])->name('customer_page');
            Route::get('/tambah-pelanggan', [CrudCustomerController::class, 'addcustomer'])->name('add_customer');
            Route::post('/buat-pelanggan-baru', [CrudCustomerController::class, 'newcustomer'])->name('new_pelanggan');
            Route::get('/edit-pelanggan/{id}', [CrudCustomerController::class, 'datacustomer'])->name('data_customer');
            Route::post('/update-pelanggan/{id}', [CrudCustomerController::class, 'updatecustomer'])->name('update_customer');
            Route::get('/hapus-pelanggan/{id}', [CrudCustomerController::class, 'deletecustomer'])->name('delete_customer');
        });
        // Route Product
        Route::prefix('/data-produk')->group(function () {
            Route::get('/', [productController::class, 'index'])->name('product');
            Route::get('/create', [productController::class, 'create'])->name('product.create');
            Route::post('/store', [productController::class, 'store'])->name('product.store');
            Route::get('/show/{id}', [productController::class, 'show'])->name('product.show');
            Route::get('/edit/{id}', [productController::class, 'edit'])->name('product.edit');
            Route::put('/update/{id}', [productController::class, 'update'])->name('product.update');
            Route::get('/restock', [productController::class, 'restock'])->name('product.restock');
            Route::post('/restockproduct/{id}', [productController::class, 'restockproduct'])->name('product.restockproduct');
            Route::get('/updatestock/{id}', [productController::class, 'updatestock'])->name('product.updatestock');
            Route::post('/editstock/{id}', [productController::class, 'editstock'])->name('product.editstock');
            Route::delete('/delete/{id}', [productController::class, 'destroy'])->name('product.destroy');
        });
        //Route Satuan 
        Route::prefix('/satuan')->group(function () {
            Route::get('/', [UnitController::class, 'unit'])->name('unit_page');
            Route::get('/tambah-unit', [UnitController::class, 'addunit'])->name('add_unit');
            Route::post('/buat-unit-baru', [UnitController::class, 'newunit'])->name('new_unit');
            Route::get('/edit-unit/{id}', [UnitController::class, 'dataunit'])->name('data_unit');
            Route::post('/update-unit/{id}', [UnitController::class, 'updateunit'])->name('update_unit');
            Route::get('/hapus-unit/{id}', [UnitController::class, 'deleteunit'])->name('delete_unit');
        });
        // Route History
        Route::get('/riwayat-penjualan', [HistoryController::class, 'history'])->name('history');
    });

});
