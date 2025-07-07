<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Get a user and a product for the relations
        $user = User::first();
        $product = Product::first();

        if (!$user || !$product) {
            $this->command->warn('No users or products found. Please seed users and products first.');
            return;
        }

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $product->price * 2,
            'status' => 'completed',
        ]);

        // Create order items
        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Create payment
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'bank_transfer',
            'payment_reference' => 'PAY123456',
            'paid_amount' => $order->total,
            'status' => 'completed',
        ]);
    }
}