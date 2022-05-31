<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\SupplierAuthController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\BackEndPesananController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PageShopController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MpesananController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\PesananPerbarangController;
use App\Http\Controllers\SettingAkunSupplierController;
use App\Http\Controllers\DaftarPembeliController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\LaporanPenjualanController; 


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
    Route::get('logout/user', function () {
        Auth::guard('web')->logout();
    return view('front.dashboard');
});

Route::get('/', function () {
     return view('admin.dashboard');
});
Route::get('/contact-us', function () {
     return view('front.contact-us');
});
Route::get('login/supplier', function () {
    return view('admin.login_supplier');
});
Route::get('login/pembeli', function () {
    return view('front.login');
});
Route::get('register/pembeli', function () {
    return view('front.register');
});
Route::get('register/supplier', function () {
    return view('admin.registrasi_supplier');
});

Route::post('register/akun/supplier',[SupplierAuthController::class,'register']);
Route::post('register/akun/pembeli',[RegisterController::class,'registeruser']);
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
    
    Route::get('barang/destroy/{id_barang}', 'destroy')->name('barang.destroy');

});
Route::controller(JenisTransaksiController::class)->group(function(){

    Route::get('transaksi', 'index')->name('transaksi.index');

    Route::post('transaksi', 'store')->name('transaksi.store');

    Route::get('transaksi/create', 'create')->name('transaksi.create');

    Route::get('transaksi/{id_transaksi}', 'show')->name('transaksi.show');
    
    Route::get('transaksi/edit/{id_transaksi}', 'edit')->name('transaksi.edit');
    
    Route::post('transaksi/update/{id_transaksi}', 'update')->name('transaksi.update');
    
    Route::delete('transaksi/destroy/{id_transaksi}', 'destroy')->name('transaksi.destroy');

});

Route::controller(MasterKategoriController::class)->group(function(){

    Route::get('kategoriseafood', 'index')->name('kategorisea.index');

    Route::post('kategoriseafood', 'store')->name('kategorisea.store');

    Route::get('kategoriseafood/create', 'create')->name('kategorisea.create');

    Route::get('kategoriseafood/{id_kategori}', 'show')->name('kategorisea.show');
    
    Route::get('kategoriseafood/edit/{id_kategori}', 'edit')->name('kategorisea.edit');
    
    Route::post('kategoriseafood/update/{id_kategori}', 'update')->name('kategorisea.update');
    
    Route::delete('kategoriseafood/{item}', 'destroy')->name('kategorisea.destroy');

});

Route::controller(MpesananController::class)->group(function(){

    Route::get('kategori', 'index')->name('kategori.index');

    Route::post('kategori', 'store')->name('kategori.store');

    Route::get('kategori/create', 'create')->name('kategori.create');

    Route::get('kategori/{id_kategori}', 'show')->name('kategori.show');
    
    Route::get('kategori/edit/{id_kategori}', 'edit')->name('kategori.edit');
    
    Route::post('kategori/update/{id_kategori}', 'update')->name('kategori.update');
    
    // Route::delete('kategori/{item}', 'destroy')->name('barang.destroy');

});
Route::controller(PesananPerbarangController::class)->group(function(){

    Route::get('laporan_perbarang', 'index')->name('laporan_perbarang.index');

    Route::post('laporan_perbarang', 'store')->name('laporan_perbarang.store');

    Route::get('laporan_perbarang/create', 'create')->name('laporan_perbarang.create');

    Route::get('laporan_perbarang/{id_kategori}', 'show')->name('laporan_perbarang.show');
    
    Route::get('laporan_perbarang/edit/{id_kategori}', 'edit')->name('laporan_perbarang.edit');
    
    Route::post('laporan_perbarang/update/{id_kategori}', 'update')->name('laporan_perbarang.update');
    
    // Route::delete('laporan_perbarang/{item}', 'destroy')->name('barang.destroy');

});
Route::controller(SettingAkunSupplierController::class)->group(function(){

    Route::get('settingAkunSupplier', 'index')->name('settingAkunSupplier.index');

    Route::post('settingAkunSupplier', 'store')->name('settingAkunSupplier.store');

    Route::get('settingAkunSupplier/create', 'create')->name('settingAkunSupplier.create');

    Route::get('settingAkunSupplier/{id_kategori}', 'show')->name('settingAkunSupplier.show');
    
    Route::get('settingAkunSupplier/edit/{id_kategori}', 'edit')->name('settingAkunSupplier.edit');
    
    Route::post('settingAkunSupplier/update/{id_kategori}', 'update')->name('settingAkunSupplier.update');
    
    // Route::delete('settingAkunSupplier/{item}', 'destroy')->name('barang.destroy');

});
Route::controller(DaftarPembeliController::class)->group(function(){

    Route::get('daftarPembeli', 'index')->name('daftarPembeli.index');

});
Route::controller(LaporanPenjualanController::class)->group(function(){

    Route::get('penjualan', 'index')->name('lappenjualan.index');
    Route::get('laporan_penjualan/detail/{id_transaksi}', 'show')->name('laporan_penjualan.detail');
    Route::get('laporan_penjualan/acc_pembayaran/{id_transaksi}', 'acc_pembayaran')->name('laporan_penjualan.acc_pembayaran');
});
Route::controller(ContactUsController::class)->group(function(){

    Route::get('contactUs', 'index')->name('contactUs.index');
    Route::post('contactUs/store', 'store')->name('contactUs.store');

});
Route::controller(UserController::class)->group(function(){

    Route::get('user', 'index')->name('user.index');
    Route::get('user/create', 'create')->name('user.create');
    Route::post('user/store', 'store')->name('user.store');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
