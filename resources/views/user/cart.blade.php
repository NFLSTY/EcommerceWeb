@extends('user.layouts.layout')

@section('title', 'Shopping Cart')

@section('content')
<div class="container-fluid banner-tampilan d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center">Shopping Cart</h1>
    </div>
</div>

<div class="container my-5">
    <h2 class="mb-4">Your Shopping Cart</h2>
    <?php if (count($cart) > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
  $grandTotal = 0;
  foreach ($cart as $item):
    $total = $item['harga'] * $item['qty'];
    $grandTotal += $total;
            ?>
        <tr>
          <td><img src="../image/<?php    echo $item['foto'] ?>" width="80"></td>
          <td><?php    echo $item['nama'] ?></td>
          <td>Rp <?php    echo number_format($item['harga'], 0, ',', '.') ?></td>
          <td><?php    echo $item['qty'] ?></td>
          <td>Rp <?php    echo number_format($total, 0, ',', '.') ?></td>
        </tr>
        <?php  endforeach; ?>
        <tr>
          <td colspan="4"><strong>Total Semua</strong></td>
          <td><strong>Rp <?php  echo number_format($grandTotal, 0, ',', '.') ?></strong></td>
        </tr>
      </tbody>
    </table>
    <div class="text-end mt-3">
      <a href="checkout.php" class="btn btn-primary me-2">Checkout</a>
      <a href="{{ url('/purchase-history') }}" class="btn btn-secondary">View Purchase History</a>
    </div>
    <?php else: ?>
    <p>Your cart is empty</p>
    <?php endif; ?>
  </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning" 
                            onclick="return confirm('Yakin ingin kosongkan keranjang?')">
                        <i class="fas fa-trash-alt"></i> Kosongkan Keranjang
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('products') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Lanjut Belanja
                </a>
                <a href="{{ route('checkout') }}" class="btn btn-success">
                    <i class="fas fa-credit-card"></i> Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h4>Keranjang Anda Kosong</h4>
            <p class="text-muted">Belum ada produk di keranjang belanja Anda.</p>
            <a href="{{ route('products') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Auto-submit form when quantity is changed
document.querySelectorAll('input[name="qty"]').forEach(function(input) {
    input.addEventListener('change', function() {
        this.closest('form').submit();
    });
});

// Update cart count in navbar (if you have a cart badge)
function updateCartCount() {
    fetch('{{ route("cart.count") }}')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.querySelector('.cart-count');
            if (cartBadge) {
                cartBadge.textContent = data.count;
            }
        });
}

// Call on page load
document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
@endpush
