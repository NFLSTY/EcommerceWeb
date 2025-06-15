<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showProduct()
    {
        $products = Product::latest()->limit(20)->get();
        return view('user.home', compact('products'));
    }
}
