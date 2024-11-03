<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');
Route::view('/products', 'products.products')->name('products');
Route::view('/products/prod', 'products.prod_details')->name('prod_details');
