<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoryController extends Controller
{
public function index()
{
    // Eager load orderItems and their products
    $purchases = Order::with(['orderItems.product', 'payment'])
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    // Add total_price and total_quantity to each purchase
    $purchases->each(function ($purchase) {
        $purchase->total_quantity = $purchase->orderItems->sum('quantity');
        $purchase->total_price = $purchase->orderItems->map(function ($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        })->sum();
    });

    return view('user.purchase-history', compact('purchases'));
}
}