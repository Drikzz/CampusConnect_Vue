<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;

Route::get('/', [ProductController::class, 'welcome'])->name('index');

// products statics
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/prod/{id}', [ProductController::class, 'product_details'])->name('prod.details');
Route::get('/trade', [ProductController::class, 'trade'])->name('trade');

// Route::get('/trade', [ProductController::class, 'index'])->name('products');
// Route::get('/trade/prod/{id}', [ProductController::class, 'product_details'])->name('prod.details');



Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // dashboard routes for user

    // Add this route before the auth middleware group
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/address', [DashboardController::class, 'address']);

    // reserve for dynamic route for the order
    // Route::get('/dashboard/orders/{status}', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');

    Route::get('/dashboard/favorites', [DashboardController::class, 'favorites']);
    Route::get('/dashboard/sell', [DashboardController::class, 'sell'])->name('dashboard.sell');

    Route::get('/dashboard/sell/terms', [DashboardController::class, 'terms'])->name('dashboard.terms');
    Route::post('/dashboard/sell/terms', [UserController::class, 'is_seller']);

    //checkout routes
    Route::get('/products/prod/{id}/summary', [CheckoutController::class, 'summary'])->name('summary');
    Route::post('/checkout/process', [CheckoutController::class, 'checkout'])->name('checkout.process');
});

Route::middleware(['auth', 'seller'])->group(function () {  // Changed 'Seller' to 'seller'

    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/seller/products/add', [SellerController::class, 'create'])->name('seller.addproduct');
    Route::post('/seller/products/add', [SellerController::class, 'store']);
    Route::get('/seller/products', [SellerController::class, 'products'])->name('seller.products');
    // Route::view('/', 'seller.product')->name('myproduct');
    // Route::view('/addproduct', 'seller.addproduct')->name('addproduct');
    // Route::view('/editproduct', 'seller.editproduct')->name('editproduct');
    Route::view('/wallet', 'seller.wallet')->name('wallet');

    Route::get('/seller/orders', [OrderController::class, 'index'])->name('seller.orders.index');
    Route::get('/seller/orders/pending', [OrderController::class, 'pending'])->name('seller.orders.pending');
    Route::get('/seller/orders/processing', [OrderController::class, 'processing'])->name('seller.orders.processing');
    Route::get('/seller/orders/completed', [OrderController::class, 'completed'])->name('seller.orders.completed');
    Route::get('/seller/orders/{order}', [OrderController::class, 'show'])->name('seller.orders.show');
    Route::patch('/seller/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('seller.orders.status');

    Route::get('/seller/products/{product}/edit', [SellerController::class, 'edit'])->name('seller.products.edit');
    Route::post('/seller/products/{product}/update', [SellerController::class, 'update'])->name('seller.products.update');
    Route::delete('/seller/products/{product}/remove', [SellerController::class, 'destroy'])->name('seller.products.delete');
    Route::delete('/seller/products/{product}', [SellerController::class, 'destroy'])->name('seller.products.delete');
    // Note: Changed from PUT to POST for better file upload compatibility

    // // Categories routes
    // Route::get('/seller/categories', [SellerController::class, 'categories'])->name('seller.categories');
});

Route::middleware('guest')->group(function () {

    Route::get('/register/highschool', [AuthController::class, 'register_form_highschool'])->name('register_form_highschool');
    Route::post('/register/highschool', [AuthController::class, 'registerHSStudent'])->name('registerHSStudent');

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

    // IF LOGOUT LINK IS PRESENT, UNCOMMENT THIS ROUTE //
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// Admin Authentication Routes
// Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Dashboard Route
Route::get('/admin/dashboard', function () {
    return view('admin.admin-dashboard');
})->name('admin.dashboard');

Route::get('/admin/sales', function () {
    return view('admin.admin-sales');
})->name('admin.sales');

Route::get('/admin/transactions', function () {
    return view('admin.admin-transactions');
})->name('admin.transactions');

Route::get('/admin/users', function () {
    return view('admin.admin-userManagement');
})->name('admin.users');

Route::get('/admin/reports', function () {
    return view('admin.admin-reportManagement');
})->name('admin.reports');

Route::get('/admin/products', function () {
    return view('admin.admin-productManagement');
})->name('admin.products');

Route::get('/admin/funds', function () {
    return view('admin.admin-fundManagement');
})->name('admin.funds');


// PLS DON'T DELETE THIS CODE FOR A WHILE
// Protected Admin Routes
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     // Route::get('/sales', [AdminController::class, 'sales'])->name('admin.sales');
//     // Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
//     // Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
//     // Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
//     Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
//     Route::get('/funds', [AdminController::class, 'funds'])->name('admin.funds');
// });

// Route::view('/admin/sales', 'admin.admin-sales')->name('adminsales');

// Route::view('/admin/products', 'admin.admin-productManagement')->name('admin-product-management');
Route::view('/admin/userManagement', 'admin.admin-userManagement')->name('admin-userManagement');
// Route::view('/admin/funds', 'admin.admin-fundManagement')->name('admin-funds');

// Route::view('/Adminside-userprofile', 'admin.adminside-userprofile  ')->name('admin-userManagement');
// Route::view('/Admin-transactions', 'admin.admin-transactions')->name('admin-transactions');

Route::view('/Admin-user-approve', 'admin.admin-user-approved')->name('admin-user-approved');
