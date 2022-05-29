<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\SupplierAuthController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\BackEndPesananController;
use App\Http\Controllers\PageShopController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MpesananController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/seafood', function () {
     return view('front.dashboard');
});

Route::get('/', function () {
     return view('admin.dashboard');
});
Route::get('login/supplier', function () {
    return view('admin.login_supplier');
});
Route::get('login/pembeli', function () {
    return view('front.login');
});
Route::get('register/supplier', function () {
    return view('admin.registrasi_supplier');
});

Route::post('register/akun/supplier',[SupplierAuthController::class,'register']);
Route::post('login/supplier/store',[SupplierAuthController::class,'login']);
Route::get('supplier/logout',[SupplierAuthController::class,'logout']);

Route::post('add/item/cekout',[BackEndPesananController::class,'tambahKeranjang']);
Route::post('add/item/komentar',[BackEndPesananController::class,'komentarProduk']);
Route::post('get/item/komentar/{id_barang}',[BackEndPesananController::class,'getkomentarProduk']);
Route::post('hapus/item/komentar/{id_komentar}',[BackEndPesananController::class,'hapuskomentarProduk']);
Route::get('detail/barang/{id}',[BackEndPesananController::class,'detailBarang']);


Route::controller(PesananController::class)->group(function(){

    Route::get('pesanan', 'index')->name('pesanan.index');
    Route::get('pesanan/riwayat', 'riwayatPesanan')->name('riwayatPesanan.index');
    Route::post('pesanan/destroy/{id_pesanan}', 'destroy')->name('pesanan.destroy');
    Route::get('pesanan/detail/{id_pesanan}', 'show')->name('pesanan.detail');
    Route::post('pesanan/destroyTransaksi/{id_pesanan}', 'destroyTransaksi')->name('pesanan.destroyTransaksi');
    Route::post('pesanan/proses/cekout', 'store')->name('pesanan.store');
    Route::post('pesanan/update', 'update')->name('pesanan.update');

});
Route::controller(PageShopController::class)->group(function(){

    Route::get('shop', 'index')->name('shop.index');

});

Route::controller(MasterBarangController::class)->group(function(){

    Route::get('barang', 'index')->name('barang.index');

    Route::post('barang', 'store')->name('barang.store');

    Route::get('barang/create', 'create')->name('barang.create');

    Route::get('barang/{id_barang}', 'show')->name('barang.show');
    
    Route::get('barang/edit/{id_barang}', 'edit')->name('barang.edit');
    
    Route::post('barang/update/{id_barang}', 'update')->name('barang.update');
    Route::post('barang/tambahStock', 'tambahStock')->name('barang.tambahStock');
    
    Route::delete('barang/{item}', 'destroy')->name('barang.destroy');

});

Route::controller(MasterKategoriController::class)->group(function(){

    Route::get('kategori', 'index')->name('kategori.index');

    Route::post('kategori', 'store')->name('kategori.store');

    Route::get('kategori/create', 'create')->name('kategori.create');

    Route::get('kategori/{id_kategori}', 'show')->name('kategori.show');
    
    Route::get('kategori/edit/{id_kategori}', 'edit')->name('kategori.edit');
    
    Route::post('kategori/update/{id_kategori}', 'update')->name('kategori.update');
    
    Route::delete('kategori/{item}', 'destroy')->name('barang.destroy');

});

Route::controller(MpesananController::class)->group(function(){

    Route::get('kategori', 'index')->name('kategori.index');

    Route::post('kategori', 'store')->name('kategori.store');

    Route::get('kategori/create', 'create')->name('kategori.create');

    Route::get('kategori/{id_kategori}', 'show')->name('kategori.show');
    
    Route::get('kategori/edit/{id_kategori}', 'edit')->name('kategori.edit');
    
    Route::post('kategori/update/{id_kategori}', 'update')->name('kategori.update');
    
    Route::delete('kategori/{item}', 'destroy')->name('barang.destroy');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
