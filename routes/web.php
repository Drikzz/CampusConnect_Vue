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

// Move these routes before any middleware groups
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Admin login routes

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Combined Dashboard and Seller routes
    Route::middleware('auth')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
        Route::get('/wishlist', [DashboardController::class, 'wishlist'])->name('dashboard.wishlist');
        Route::get('/address', [DashboardController::class, 'address'])->name('dashboard.address');
        Route::get('/reviews', [DashboardController::class, 'reviews'])->name('dashboard.reviews');

        // Profile update route
        Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
        Route::delete('/wishlist/{wishlist}', [DashboardController::class, 'removeFromWishlist'])->name('wishlist.remove');

        // Add new seller registration routes
        Route::get('/become-seller', [DashboardController::class, 'showSellerRegistration'])->name('dashboard.become-seller');
        Route::get('/seller/terms', [DashboardController::class, 'showSellerTerms'])->name('dashboard.seller.terms');
        Route::post('/seller/terms', [DashboardController::class, 'acceptSellerTerms'])->name('dashboard.seller.terms.accept');

        // Seller specific routes
        Route::middleware(['seller'])->group(function () {
            Route::get('/products', [DashboardController::class, 'products'])->name('dashboard.products');
            Route::get('/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');
            Route::get('/seller/orders', [OrderController::class, 'index'])->name('seller.orders.index');
            Route::get('/seller/products/add', [SellerController::class, 'create'])->name('seller.addproduct');
            Route::post('/seller/products/add', [SellerController::class, 'store']);
            Route::get('/seller/products/{product}/edit', [SellerController::class, 'edit'])->name('seller.products.edit');
            Route::post('/seller/products/{product}/update', [SellerController::class, 'update'])->name('seller.products.update');
            Route::delete('/seller/products/{product}/remove', [SellerController::class, 'destroy'])->name('seller.products.delete');
        });
    });

    //checkout routes
    Route::get('/products/prod/{id}/summary', [CheckoutController::class, 'summary'])->name('summary');
    Route::post('/checkout/process', [CheckoutController::class, 'checkout'])->name('checkout.process');

    // Admin product management routes
    Route::get('/admin/product-management', [AdminController::class, 'productManagement'])->name('admin.productManagement');
    Route::post('/admin/product-management/store', [AdminController::class, 'storeProduct'])->name('admin.productManagement.store');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct']);
    Route::post('/admin/products/bulk-delete', [AdminController::class, 'bulkDestroyProducts']);
    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
    Route::get('/admin/products/{id}', [AdminController::class, 'getProduct'])->name('admin.getProduct'); // Ensure this route is defined
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showPersonalInfoForm'])->name('register.personal-info');
    Route::post('/register/step1', [AuthController::class, 'processPersonalInfo'])->name('register.step1');
    Route::get('/register/details', [AuthController::class, 'showDetailsForm'])->name('register.details');
    Route::post('/register/complete', [AuthController::class, 'completeRegistration'])->name('register.complete');

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
});

// Admin routes with middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::resource('productManagement', 'ProductManagementController');
    
    Route::get('/dashboard2', [AdminController::class, 'dashboard2'])->name('admin-dashboard2');
    Route::get('/userManagement', [AdminController::class, 'userManagement'])->name('admin-userManagement');
    Route::get('/userManagement/create', [AdminController::class, 'create'])->name('admin-userManagement.create');
    Route::post('/userManagement', [AdminController::class, 'store'])->name('admin-userManagement.store');
    Route::get('/userManagement/{user}/edit', [AdminController::class, 'edit'])->name('admin-userManagement.edit');
    Route::put('/userManagement/{user}', [AdminController::class, 'update'])->name('admin-userManagement.update');
    Route::delete('/userManagement/{user}', [AdminController::class, 'destroy'])->name('admin-userManagement.destroy');
    Route::get('/userManagement/{user}', [AdminController::class, 'show'])->name('admin-userManagement.show');

    Route::get('/product-management', [AdminController::class, 'productManagement'])->name('admin.productManagement');
    Route::post('/product-management/store', [AdminController::class, 'storeProduct'])->name('admin.productManagement.store');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct']);
    Route::post('/products/bulk-delete', [AdminController::class, 'bulkDestroyProducts']);
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
    Route::get('/products/{id}', [AdminController::class, 'getProduct'])->name('admin.getProduct');
    
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::delete('/transactions/{id}', [AdminController::class, 'destroyTransaction'])->name('admin.transactions.destroy');
    Route::post('/transactions/bulk-delete', [AdminController::class, 'bulkDestroyTransactions'])->name('admin.transactions.bulkDestroy');
    Route::post('/transactions/{id}/cancel', [AdminController::class, 'cancelTransaction']);
    
    Route::get('/users', function () {
        return view('admin.admin-userManagement');
    })->name('admin.users');

    Route::view('/admin/login', 'admin.adminlogin')->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/login/filter', [AdminController::class, 'login'])->name('admin.login.filter');

});
