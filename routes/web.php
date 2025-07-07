<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('/product-details', function () {
    return view('user.product-details');
})->name('product-details');

Route::get('/cart', function () {
    return view('user.cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('user.checkout');
})->name('checkout');

Route::get('/purchase-history', function () {
    return view('user.purchase-history');
})->name('purchase-history');


// Admin Dashboard (only admin can access it)
Route::middleware('can:access-admin')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Category CRUD (admin)
    Route::resource('admin/categories', CategoryController::class, [
        'as' => 'admin'
    ]);
    // Product CRUD (admin)
    Route::resource('admin/products', ProductController::class, [
        'as' => 'admin'
    ]);
});




// Login & Register
Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Profile display and editing
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProfileController::class, 'updateProfileImage'])->name('profile.image.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
});