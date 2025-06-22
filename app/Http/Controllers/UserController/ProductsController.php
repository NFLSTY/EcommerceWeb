<?php

namespace App\Http\Controllers\UserController;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::latest();

        if ($request->has('keyword')) {
            $products->where('name', 'like', '%' . $request->keyword . '%');
        } elseif ($request->has('category')) {
            $category = Category::where('name', $request->category)->first();
            if ($category) {
                $products->where('category_id', $category->id);
            } else {
                $products = collect(); // empty collection
            }
        }

        if ($products instanceof \Illuminate\Database\Eloquent\Builder) {
            $products = $products->get();
        }

        return view('user.products', compact('categories', 'products'));
    }
}