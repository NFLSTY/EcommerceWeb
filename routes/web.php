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







// Profile routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Profile display and editing
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Profile image upload
    Route::post('/profile/image', [ProfileController::class, 'updateProfileImage'])->name('profile.image.update');
    
    // Password update
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Additional profile sections
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::patch('/profile/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications.update');
});