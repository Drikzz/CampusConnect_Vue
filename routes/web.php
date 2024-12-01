<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::get('/dashboard', function () {
    return view('seller.dashboard'); 
});
Route::view('/dashboard', 'seller.dashboard')->name('dashboard');
Route::view('/', 'seller.product')->name('myproduct');
Route::view('/addproduct', 'seller.addproduct')->name('addproduct');
Route::view('/editproduct', 'seller.editproduct')->name('editproduct');
Route::view('/wallet', 'seller.wallet')->name('wallet');