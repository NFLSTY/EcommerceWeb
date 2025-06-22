<?php

use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/product', function () {
    return view('admin.product');
})->name('product');

Route::get('/category', function () {
    return view('admin.category');
})->name('category');

Route::get('/category-detail', function () {
    return view('admin.category-detail');
})->name('category-detail');

Route::get('/product-detail', function () {
    return view('admin.product-detail');
})->name('product-detail');

Route::get('/login', function () {
    return view('admin.login');
})->name('login');

// Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Route::get('/product-details', function () {
//     return view('user.product-details');
// })->name('product-details');

// Route::get('/cart', function () {
//     return view('user.cart');
// })->name('cart');

// Route::get('/profile', function () {
//     return view('user.profile');
// })->name('profile');

// Route::get('/login', function () {
//     return view('user.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('user.register');
// })->name('register');

// Route::get('/checkout', function () {
//     return view('user.checkout');
// })->name('checkout');

// Route::get('/purchase-history', function () {
//     return view('user.purchase-history');
// })->name('purchase-history');

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\adminController\DashboardController::class, 'index'])->name('admin.dashboard');
//     // Add more admin routes here
// });
