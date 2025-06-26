<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $username = Auth::user() ? Auth::user()->name : 'Admin';
        $category = Category::first(); // Get the first category (or null if none)
        $product = Product::first();   // Get the first product (or null if none)
        return view('admin.dashboard', compact('totalCategory', 'totalProduct', 'username', 'category', 'product'));
    }
}
