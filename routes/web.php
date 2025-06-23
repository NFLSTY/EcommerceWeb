<?php

use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('category', CategoryController::class);

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category-detail');

Route::resource('product-index', ProductController::class);