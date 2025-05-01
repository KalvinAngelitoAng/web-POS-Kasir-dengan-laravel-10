<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;

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


// Login
Route::get('/', [AuthController::class, 'index']);
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth','checkRole:admin']], function(){

    // Crud Data User
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

    // Crud Data Jenis Barang
    Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
    Route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
    Route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
    Route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);

    // Crud Data Barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/update/{id}', [BarangController::class, 'update']);
    Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);

    // Setting Diskon
    Route::get('/setdiskon', [DiskonController::class, 'index']);
    Route::post('/setdiskon/update/{id}', [DiskonController::class, 'update']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak']);

});

Route::group(['middleware' => ['auth','checkRole:admin,kasir']], function(){

    Route::get('/home', [HomeController::class, 'index']);

    // Setting Profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile/updateprofile/{id}', [UserController::class, 'updateprofile']);

    // Data Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi/get_detail_barang', [TransaksiController::class, 'get_detail_barang']);
    Route::post('/transaksi/addToCart', [TransaksiController::class, 'addToCart']);
    Route::get('/transaksi/deleteCart/{id}', [TransaksiController::class, 'deleteCart']);
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);

    Route::get('/transaksi/detail/{no_transaksi}', [TransaksiController::class, 'detail']);
    Route::get('/transaksi/cetakinvoice/{no_transaksi}', [TransaksiController::class, 'cetakinvoice']);
    Route::get('/transaksi/cetakfaktur/{no_transaksi}', [TransaksiController::class, 'cetakfaktur']);

    //Data Member
    Route::get('/transaksi/create2', [MemberController::class, 'create'])->name('member.create');
    Route::post('/transaksi/create2', [MemberController::class, 'store']);

});
