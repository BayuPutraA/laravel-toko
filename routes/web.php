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
    Route::get('/pembeli', [StaffController::class, 'pembeli'])->name('pembeli');
    Route::get('/barang', [StaffController::class, 'barang'])->name('barang');
    Route::get('/konfirmasi', [StaffController::class, 'konfirmasi'])->name('konfirmasi');

});

Route::group(['middleware' => 'pembeli.session'],function () {
    Route::get('/market', [PembeliController::class, 'market'])->name('market');
    Route::get('/history', [PembeliController::class, 'history'])->name('history');

});
