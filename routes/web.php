<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::get('/dashboard', function () {
    return view('seller.dashboard'); 
});