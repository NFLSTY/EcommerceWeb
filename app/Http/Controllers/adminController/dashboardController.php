<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $username = Auth::user() ? Auth::user()->name : 'Admin';
        return view('admin.dashboard', compact('totalCategory', 'totalProduct', 'username'));
    }
}
