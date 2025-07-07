<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(20)->get();
        $categories = Category::all();

        return view('user.home', compact('products', 'categories'));
    }
}
