<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);

        // Jika cart kosong, redirect ke halaman cart
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong! Silakan tambahkan produk terlebih dahulu.');
        }

        // Ambil data produk dari database
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        $cartWithData = [];
        $grandTotal = 0;

        // Hitung total dan siapkan data
        foreach ($products as $product) {
            $qty = $cart[$product->id];
            $total = $product->price * $qty;
            $grandTotal += $total;

            $cartWithData[] = [
                'id' => $product->id,
                'name' => $product->name,
                'image_url' => $product->image_url,
                'price' => $product->price,
                'qty' => $qty,
                'total' => $total,
            ];
        }

        return view('user.checkout.index', [
            'cart' => $cartWithData,
            'grandTotal' => $grandTotal,
        ]);
    }

    /**
     * Proses pembayaran dan checkout.
     */
    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'metode' => 'required|in:transfer,cod,ewallet',
            'phone' => 'required|string|max:20',
        ]);

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        try {
            DB::beginTransaction();

            // Ambil data produk dan hitung total
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();
            
            $grandTotal = 0;
            $orderItems = [];

            foreach ($products as $product) {
                $qty = $cart[$product->id];
                $total = $product->price * $qty;
                $grandTotal += $total;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'total' => $total,
                ];
            }

            // Determine order status based on payment method
            $orderStatus = ($request->metode == 'cod') ? 'pending' : 'shipped';
            $paymentStatus = ($request->metode == 'cod') ? 'pending' : 'completed';

            // Buat order baru
            $order = Order::create([
                'user_id' => 1, // You can change this to Auth::id() when authentication is implemented
                'total' => $grandTotal,
                'status' => $orderStatus,
            ]);

            // Simpan order items
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Simpan payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->metode,
                'paid_amount' => $grandTotal,
                'status' => $paymentStatus,
            ]);

            DB::commit();

            // Kosongkan cart setelah berhasil checkout
            session()->forget('cart');

            // Different success messages based on payment method
            $successMessage = ($request->metode == 'cod') 
                ? 'Pesanan berhasil dibuat! Pembayaran akan dilakukan saat barang sampai. 🚚' 
                : 'Pesanan berhasil dibuat dan pembayaran telah dikonfirmasi! 🎉';

            return redirect()->route('checkout.success', $order->id)
                           ->with('success', $successMessage);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman sukses setelah checkout.
     */
    public function success($orderId)
    {
        $order = Order::where('id', $orderId)->with(['orderItem.product', 'payment'])->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order tidak ditemukan!');
        }

        return view('user.checkout.success', compact('order'));
    }

    /**
     * Test checkout page dengan dummy data.
     */
    public function testUI()
    {
        // Dummy cart data untuk testing checkout UI
        $cart = [
            [
                'id' => 999,
                'nama' => 'Laptop Gaming ASUS ROG Strix',
                'foto' => 'laptop.jpg',
                'harga' => 15000000,
                'qty' => 1,
                'total' => 15000000,
            ],
            [
                'id' => 998,
                'nama' => 'Mouse Gaming Logitech G502',
                'foto' => 'mouse.jpg',
                'harga' => 500000,
                'qty' => 2,
                'total' => 1000000,
            ],
            [
                'id' => 997,
                'nama' => 'Keyboard Mechanical RGB',
                'foto' => 'keyboard.jpg',
                'harga' => 750000,
                'qty' => 1,
                'total' => 750000,
            ],
            [
                'id' => 996,
                'nama' => 'Monitor 4K Samsung 27"',
                'foto' => 'monitor.jpg',
                'harga' => 3500000,
                'qty' => 1,
                'total' => 3500000,
            ],
        ];

        $grandTotal = array_sum(array_column($cart, 'total'));

        return view('user.checkout.index', [
            'cart' => $cart,
            'grandTotal' => $grandTotal,
        ]);
    }

    /**
     * Test success page dengan dummy order data.
     */
    public function testSuccess()
    {
        // Dummy order data untuk testing success page
        $order = (object) [
            'order_number' => 'ORD-TEST123',
            'tanggal_order' => now(),
            'status' => 'pending',
            'nama_pelanggan' => 'John Doe',
            'phone' => '+62812345678',
            'alamat_pengiriman' => 'Jl. Contoh No. 123, Jakarta Selatan',
            'total_amount' => 20750000,
            'payment' => (object) [
                'metode_pembayaran' => 'transfer',
                'status' => 'pending'
            ],
            'orderItems' => [
                (object) [
                    'product' => (object) ['nama' => 'Laptop Gaming ASUS ROG Strix'],
                    'harga' => 15000000,
                    'qty' => 1,
                    'total' => 15000000,
                ],
                (object) [
                    'product' => (object) ['nama' => 'Mouse Gaming Logitech G502'],
                    'harga' => 500000,
                    'qty' => 2,
                    'total' => 1000000,
                ],
                (object) [
                    'product' => (object) ['nama' => 'Keyboard Mechanical RGB'],
                    'harga' => 750000,
                    'qty' => 1,
                    'total' => 750000,
                ],
                (object) [
                    'product' => (object) ['nama' => 'Monitor 4K Samsung 27"'],
                    'harga' => 3500000,
                    'qty' => 1,
                    'total' => 3500000,
                ],
            ]
        ];

        return view('user.checkout.success', compact('order'));
    }
}
