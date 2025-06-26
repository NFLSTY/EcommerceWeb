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
// Route::resource('categories', CategoryController::class, [
//     'as' => 'admin' // route names like admin.categories.index, etc.
// ]);
Route::get('/categories/category-index', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/categories/category-create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::get('/categories/category-edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::get('/categories/category-show', [CategoryController::class, 'show'])->name('admin.categories.show');
Route::get('/categories/category-destroy', [ProductController::class, 'destroy'])->name('admin.categories.destroy');

// Product CRUD (admin)
// Route::resource('products', ProductController::class, [
//     'as' => 'admin' // route names like admin.products.index, etc.
// ]);
Route::get('/products/product-index', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('/products/product-create', [ProductController::class, 'create'])->name('admin.products.create');
Route::get('/products/product-edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::get('/products/product-show', [ProductController::class, 'show'])->name('admin.products.show');
Route::get('/products/product-destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');