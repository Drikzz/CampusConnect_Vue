<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome')->name('index');









// UNCOMMENT IF THOSE LINKS ARE PRESENT //
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// IF THE REGISTER LINK IS PRESENT, UNCOMMENT THIS ROUTE //
// Route:: view('/register', 'auth.register')->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// IF LOGOUT LINK IS PRESENT, UNCOMMENT THIS ROUTE //
// Route:: view('/login', 'auth.login')->name('login');
// Route::post('/login', [AuthController::class, 'login']);