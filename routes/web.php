<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/profile', function () {
    return view('user.profile');
})->name('profile');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::get('/checkout', function () {
    return view('user.checkout');
})->name('checkout');

Route::get('/purchase-history', function () {
    return view('user.purchase-history');
})->name('purchase-history');

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\adminController\DashboardController::class, 'index'])->name('admin.dashboard');
//     // Add more admin routes here
// });



// Admin Dashboard
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

// Category CRUD (admin)
Route::resource('admin/categories', CategoryController::class, [
    'as' => 'admin' // route names like admin.categories.index, etc.
]);

// Product CRUD (admin)
Route::resource('admin/products', ProductController::class, [
    'as' => 'admin' // route names like admin.products.index, etc.
]);