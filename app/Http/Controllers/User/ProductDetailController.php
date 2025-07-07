<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review; 
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);
        $reviews = Review::where('product_id', $product_id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('user.product-details', compact('product', 'reviews'));
    }

    public function submitReview(Request $request, $product_id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'product_id' => $product_id,
            'user_id' => 1, 
            // pakai ini kalau misalkan fitur login sudah ada
            // 'user_id' => Auth::check() ? Auth::user()->id : null, // Check if user is authenticated
            'user_name' => $request->input('user_name'),
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('product-details', ['product_id' => $product_id])
            ->with('success_message', 'Review submitted successfully!');
    }
}