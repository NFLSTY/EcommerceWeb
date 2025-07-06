<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');

// Testing routes (remove in production)
Route::get('/testing', function () {
    return view('user.testing');
})->name('testing');
Route::get('/cart/test', [CartController::class, 'testUI'])->name('cart.test');
Route::get('/cart/add-dummy', [CartController::class, 'addDummyData'])->name('cart.dummy');
Route::get('/checkout/test', [CheckoutController::class, 'testUI'])->name('checkout.test');
Route::get('/checkout/test-success', [CheckoutController::class, 'testSuccess'])->name('checkout.test-success');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/product-details', function () {
    return view('user.product-details');
})->name('product-details');

Route::get('/profile', function () {
    return view('user.profile');
})->name('profile');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

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