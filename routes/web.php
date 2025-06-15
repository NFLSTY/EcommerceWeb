<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('user.home');
// });
Route::get('/', [HomeController::class, 'showProduct'])->name('home');

Route::get('/products', function () {
    return view('user.home');
})->name('products');

Route::get('/cart', function () {
    return view('user.home');
})->name('cart');

Route::get('/profile', function () {
    return view('user.home');
})->name('profile');

Route::get('/login', function () {
    return view('user.home');
})->name('login');

Route::get('/logout', function () {
    return view('user.home');
})->name('logout');