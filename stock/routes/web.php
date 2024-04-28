<?php

use App\Models\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokBarangController;

Route::get('/', function () {
    return view('components.auth.login');
});

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::post('/postlogin',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware'=>'check'], function(){
    Route::get('/home',[StokBarangController::class,'index'])->name('home');
    Route::get('/create-stok-barang',[StokBarangController::class,'create'])->name('create.stok');
    Route::post('/store-stok-barang',[StokBarangController::class,'store'])->name('store.stok');
    Route::get('/edit-stok-barang/{id}',[StokBarangController::class,'edit'])->name('edit.stok');
    Route::post('/update-stok-barang/{id}',[StokBarangController::class,'update'])->name('update.stok');
    Route::get('/delete-stok-barang/{id}',[StokBarangController::class,'delete'])->name('delete.stok');
});
