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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/market', function () {
    return view('market');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/users', function () {
    return view('users');
});
Route::get('/product', function () {
    return view('product');
});