<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('');
// });

Route::resource('/kategori', KategoriController::class);
Route::resource('/categori', CategoryController::class);
Route::resource('/barang', BarangController::class);
Route::resource('/barangmasuk', BarangmasukController::class);
Route::resource('/barangkeluar', BarangkeluarController::class);

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);

Route::post('/logout', [LoginController::class,'logout'])->name('logout');

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);

Route::post('register', [RegisterController::class,'store']);
Route::get('/register', [RegisterController::class,'create']);