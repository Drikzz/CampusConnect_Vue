<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'welcome'])->name('index');

// products statics
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/prod/{id}', [ProductController::class, 'product_details'])->name('prod.details');

Route::middleware('auth')->group(function () {
    // Route::view('/dashboard', 'dashboard')->name('dashboard');
    // UNCOMMENT IF THOSE LINKS ARE PRESENT //
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard');
    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // dashboard routes for user
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/address', [DashboardController::class, 'address']);

    // reserve for dynamic route for the order
    // Route::get('/dashboard/orders/{status}', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');

    Route::get('/dashboard/favorites', [DashboardController::class, 'favorites']);
    Route::get('/dashboard/sell', [DashboardController::class, 'sell'])->name('dashboard.sell');

    Route::get('/dashboard/sell/terms', [DashboardController::class, 'terms'])->name('dashboard.terms');
    Route::post('/dashboard/sell/terms', [UserController::class, 'is_verified']);

    //checkout routes
    Route::get('/products/prod/{id}/summary', [CheckoutController::class, 'summary'])->name('summary');
    Route::post('/checkout/process', [CheckoutController::class, 'checkout'])->name('checkout.process');
});

Route::middleware('guest')->group(function () {


    // Route::view('/register/elementary', '')->name('register.elementary');
    // Route::post('/register/elementary', [AuthController::class, 'elementary']);

    Route::get('/register/highschool', [AuthController::class, 'register_form_highschool'])->name('register_form_highschool');
    Route::post('/register/highshool', [AuthController::class, 'registerHSStudent'])->name('registerHSStudent');

    Route::get('/register/college', [AuthController::class, 'register_form_college'])->name('register_form_college');
    Route::post('/register/college', [AuthController::class, 'registerCollegeStudent'])->name('registerCollegeStudent');

    Route::get('/register/employee', [AuthController::class, 'register_form_employee'])->name('register_form_employee');
    Route::post('/register/employee', [AuthController::class, 'registerEmployee'])->name('registerEmployee');

    // alumni
    Route::get('/register/alumni', [AuthController::class, 'register_form_alumni'])->name('register_form_alumni');
    Route::post('/register/alumni', [AuthController::class, 'registerAlumni'])->name('registerAlumni');

    // postGraduate
    // Route::get('/register/postgraduate', [AuthController::class, 'register_form_postGraduate'])->name('register_form_postGraduate');
    Route::get('/register/postgraduate', [AuthController::class, 'register_form_postgraduate'])->name('register_form_postgraduate');
    Route::post('/register/postgraduate', [AuthController::class, 'register_postGraduate'])->name('register_postGraduate');

    //clear image when navigating away from the page
    // Route::post('/clear-preview-image', [AuthController::class, 'clearPreviewImage'])->name('clear_preview_image');

    // IF LOGOUT LINK IS PRESENT, UNCOMMENT THIS ROUTE //
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
