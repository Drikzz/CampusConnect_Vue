<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

// products statics
Route::view('/products', 'products.products')->name('products');
Route::view('/products/prod', 'products.prod_details')->name('prod_details');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');