<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PembeliController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'staff.session'],function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

    Route::get('/staff', [StaffController::class, 'staff'])->name('staff');
    Route::post('/tambah-staff', [StaffController::class, 'tambahStaff'])->name('tambahStaff');
    Route::post('/edit-staff', [StaffController::class, 'editStaff'])->name('editStaff');
    Route::get('/hapus-staff/{id}', [StaffController::class, 'hapusStaff'])->name('hapusStaff');

    Route::get('/pembeli', [StaffController::class, 'pembeli'])->name('pembeli');
    Route::post('/tambah-pembeli', [StaffController::class, 'tambahPembeli'])->name('tambahPembeli');
    Route::post('/edit-pembeli', [StaffController::class, 'editPembeli'])->name('editPembeli');
    Route::get('/hapus-pembeli/{id}', [StaffController::class, 'hapusPembeli'])->name('hapusPembeli');

    Route::get('/barang', [StaffController::class, 'barang'])->name('barang');
    Route::post('/tambah-barang', [StaffController::class, 'tambahBarang'])->name('tambahBarang');
    Route::post('/edit-barang', [StaffController::class, 'editBarang'])->name('editBarang');
    Route::get('/hapus-barang/{id}', [StaffController::class, 'hapusBarang'])->name('hapusBarang');

    Route::get('/konfirmasi', [StaffController::class, 'konfirmasi'])->name('konfirmasi');
    Route::get('/konfirmasi-pembelian/{id}', [StaffController::class, 'konfirmasiPembelian'])->name('konfirmasiPembelian');

});

Route::group(['middleware' => 'pembeli.session'],function () {
    Route::get('/market', [PembeliController::class, 'market'])->name('market');
    Route::post('/beli-barang', [PembeliController::class, 'beliBarang'])->name('beliBarang');
    Route::get('/history', [PembeliController::class, 'history'])->name('history');

});
