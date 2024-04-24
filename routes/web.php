<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DetailPembelianController;

// Routing untuk Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Routing untuk Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

// Routing untuk Fitur Product
Route::resource('products', ProductController::class);

// Routing untuk Fitur Vendor
Route::resource('vendors', VendorController::class);

// Routing untuk Fitur Pembelian
Route::resource('pembelians', PembelianController::class);



// Routing untuk Fitur Penjualan
Route::resource('penjualans', PenjualanController::class);

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/check-product', [ProductController::class, 'checkProduct'])->name('check-product');


Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store');

Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
Route::put('/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');

Route::get('/pembelians/create', [PembelianController::class, 'create'])->name('pembelians.create');
Route::post('/pembelians', [PembelianController::class, 'store'])->name('pembelians.store');

Route::get('/pembelians/{pembelian}/edit', [PembelianController::class, 'edit'])->name('pembelians.edit');
Route::put('/pembelians/{pembelian}', [PembelianController::class, 'update'])->name('pembelians.update');






Route::get('/penjualans/create', [PenjualanController::class, 'create'])->name('penjualans.create');
Route::post('/penjualans', [PenjualanController::class, 'store'])->name('penjualans.store');

Route::get('/penjualans/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualans.edit');
Route::put('/penjualans/{penjualan}', [PenjualanController::class, 'update'])->name('penjualans.update');




