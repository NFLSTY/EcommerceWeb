<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ProductDetailController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\ProductDetailController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Product detail page
Route::get('/product-details/{product_id}', [ProductDetailController::class, 'index'])->name('product-details');
Route::post('/product-details/{product_id}/review', [ProductDetailController::class, 'submitReview'])->middleware('auth')->name('product.review.submit');


// Route::get('/product-details', function () {
//     return view('user.product-details');
// })->name('product-details');
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

Route::get('/product-details/{product_id}', [ProductDetailController::class, 'index'])->name('product-details');
Route::post('/product-details/{product_id}/review', [ProductDetailController::class, 'submitReview'])->middleware('auth')->name('product.review.submit');

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
    Route::get('/profile/orders/{id}', [ProfileController::class, 'orderShow'])->name('profile.orders.show');
    Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::patch('/profile/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications.update');
});