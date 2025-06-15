<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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