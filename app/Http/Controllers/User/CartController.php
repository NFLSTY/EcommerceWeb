<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Buat ngambil user yang lagi login


class CartController extends Controller
{
    /**
     * Menampilkan halaman shopping cart.
     */
    public function index()
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);

        // Jika cart kosong, langsung return view dengan array kosong
        if (empty($cart)) {
            return view('user.cart.index', [
                'cart' => [],
                'grandTotal' => 0,
            ]);
        }

        // Ambil semua ID produk dari cart
        $productIds = array_keys($cart);

        // Ambil data produk dari database berdasarkan ID yang ada di cart
        $products = Product::whereIn('id', $productIds)->get();

        $grandTotal = 0;
        $cartWithData = [];

        // Gabungin data dari database dengan qty dari session
        foreach ($products as $product) {
            $qty = $cart[$product->id];
            $total = $product->price * $qty;
            $grandTotal += $total;

            $cartWithData[] = [
                'id' => $product->id,
                'nama' => $product->name,
                'foto' => $product->image_url,
                'harga' => $product->price,
                'qty' => $qty,
                'total' => $total,
            ];
        }

        return view('user.cart.index', [
            'cart' => $cartWithData,
            'grandTotal' => $grandTotal,
        ]);
    }

    /**
     * Menambah produk ke dalam cart.
     */
    public function add(Request $request)
    {
        // Validasi request, pastiin product_id dan qty ada
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1|max:99',
        ]);

        // Cek apakah produk masih tersedia
        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan! ❌');
        }

        // Ambil cart yang udah ada dari session, atau bikin array kosong
        $cart = session()->get('cart', []);

        $productId = $request->product_id;
        $qty = $request->qty;

        // Kalo produknya udah ada di cart, tambahin aja qty-nya
        // Kalo belum, tambahin sebagai item baru
        if (isset($cart[$productId])) {
            $cart[$productId] += $qty;
        } else {
            $cart[$productId] = $qty;
        }

        // Simpen lagi cart yang udah diupdate ke session
        session()->put('cart', $cart);

        // Redirect ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang! 🛒');
    }

    /**
     * Update quantity produk di cart.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $qty = $request->qty;

        // Update quantity jika produk ada di cart
        if (isset($cart[$productId])) {
            $cart[$productId] = $qty;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Quantity berhasil diupdate! ✅');
        }

        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang! ❌');
    }

    /**
     * Hapus produk dari cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        // Hapus produk dari cart jika ada
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang! 🗑️');
        }

        return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang! ❌');
    }

    /**
     * Kosongkan seluruh cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan! 🧹');
    }

    /**
     * Hitung total item di cart (untuk badge di navbar).
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        $totalItems = array_sum($cart);
        
        return response()->json(['count' => $totalItems]);
    }

    /**
     * Get cart data via AJAX.
     */
    public function getCartData()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        $grandTotal = 0;
        $cartWithData = [];

        foreach ($products as $product) {
            $qty = $cart[$product->id];
            $total = $product->price * $qty;
            $grandTotal += $total;

            $cartWithData[] = [
                'id' => $product->id,
                'nama' => $product->name,
                'foto' => $product->image_url,
                'harga' => $product->price,
                'qty' => $qty,
                'total' => $total,
            ];
        }

        return response()->json([
            'cart' => $cartWithData,
            'grandTotal' => $grandTotal,
            'totalItems' => array_sum($cart)
        ]);
    }

    /**
     * Add dummy data to cart for testing purposes.
     */
    public function addDummyData()
    {
        // Dummy products untuk testing
        $dummyCart = [
            1 => 2,  // Product ID 1, Quantity 2
            2 => 1,  // Product ID 2, Quantity 1
            3 => 3,  // Product ID 3, Quantity 3
        ];

        // Simpan ke session
        session()->put('cart', $dummyCart);

        return redirect()->route('cart.index')->with('success', 'Dummy data berhasil ditambahkan ke cart! 🛒');
    }

    /**
     * Generate dummy cart dengan data produk langsung (jika belum ada produk di database).
     */
    public function addDummyDataDirect()
    {
        // Dummy cart data untuk testing UI
        $dummyCartData = [
            [
                'id' => 999,
                'nama' => 'Laptop Gaming ASUS ROG',
                'foto' => 'laptop.jpg',
                'harga' => 15000000,
                'qty' => 1,
                'total' => 15000000,
            ],
            [
                'id' => 998,
                'nama' => 'Mouse Gaming Logitech',
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
        ];

        $grandTotal = array_sum(array_column($dummyCartData, 'total'));

        // Simpan ke session dengan format yang berbeda untuk testing UI
        session()->put('dummy_cart_ui', $dummyCartData);
        session()->put('dummy_grand_total', $grandTotal);

        return redirect()->route('cart.test')->with('success', 'Dummy UI data siap untuk testing! 🎨');
    }

    /**
     * Test cart page dengan dummy data.
     */
    public function testUI()
    {
        // Dummy cart data untuk testing UI
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

        return view('user.cart.index', [
            'cart' => $cart,
            'grandTotal' => $grandTotal,
        ]);
    }
}