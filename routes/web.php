<?php

use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\ProductsController;
use Illuminate\Support\Facades\Route;

// Admin Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

// Category CRUD (admin)
Route::resource('categories', CategoryController::class, [
    'as' => 'admin' // route names like admin.categories.index, etc.
]);
Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.category-add');

// Product CRUD (admin)
Route::resource('products', ProductController::class, [
    'as' => 'admin' // route names like admin.products.index, etc.
]);
Route::get('/products/product-index', [ProductController::class, 'index'])->name('admin.products.product-index');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.product-edit');