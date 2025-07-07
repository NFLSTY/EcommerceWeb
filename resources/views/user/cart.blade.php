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
    
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item['foto']) }}" 
                                alt="{{ $item['nama'] }}" 
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <input type="number" name="qty" value="{{ $item['qty'] }}" 
                                      min="1" class="form-control me-2" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Yakin ingin hapus produk ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                        <td colspan="2"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
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
