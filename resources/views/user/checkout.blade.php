@extends('user.layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container-fluid banner-tampilan d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center">Checkout</h1>
    </div>
</div>

<div class="container my-5">
    <h2 class="mb-4">Payment & Checkout</h2>

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

    @if(isset($cart) && count($cart) > 0)
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-md-8">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-user"></i> Informasi Pembeli</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon *</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Pengiriman *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="metode" class="form-label">Metode Pembayaran *</label>
                                <select class="form-select @error('metode') is-invalid @enderror" 
                                        id="metode" name="metode" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>
                                        💳 Transfer Bank
                                    </option>
                                    <option value="cod" {{ old('metode') == 'cod' ? 'selected' : '' }}>
                                        🚚 Bayar di Tempat (COD)
                                    </option>
                                    <option value="ewallet" {{ old('metode') == 'ewallet' ? 'selected' : '' }}>
                                        📱 E-Wallet (GoPay, OVO, DANA)
                                    </option>
                                </select>
                                @error('metode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-receipt"></i> Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            @foreach($cart as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item['image_url']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         style="width: 40px; height: 40px; object-fit: cover;" 
                                         class="rounded me-2">
                                    <div>
                                        <small class="fw-bold">{{ Str::limit($item['name'], 20) }}</small><br>
                                        <small class="text-muted">{{ $item['qty'] }}x</small>
                                    </div>
                                </div>
                                <span class="fw-bold">Rp {{ number_format($item['total'], 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            @endforeach
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Total:</strong>
                                <strong class="text-success fs-5">Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
                            </div>

                            <button type="submit" class="btn btn-success w-100 btn-lg">
                                <i class="fas fa-credit-card"></i> Bayar Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- Back to Cart Button -->
                    <div class="mt-3">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h4>Keranjang Kosong</h4>
            <p class="text-muted">Silakan tambahkan produk ke keranjang terlebih dahulu.</p>
            <a href="{{ route('products') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Payment method info
document.getElementById('metode').addEventListener('change', function() {
    const method = this.value;
    let info = '';
    
    switch(method) {
        case 'transfer':
            info = '<div class="alert alert-info mt-2"><small><i class="fas fa-info-circle"></i> Instruksi transfer akan dikirim setelah konfirmasi pesanan.</small></div>';
            break;
        case 'cod':
            info = '<div class="alert alert-warning mt-2"><small><i class="fas fa-truck"></i> Pembayaran dilakukan saat barang sampai di tujuan.</small></div>';
            break;
        case 'ewallet':
            info = '<div class="alert alert-success mt-2"><small><i class="fas fa-mobile-alt"></i> Link pembayaran akan dikirim ke WhatsApp Anda.</small></div>';
            break;
    }
    
    // Remove existing info
    const existingInfo = document.querySelector('.payment-info');
    if (existingInfo) existingInfo.remove();
    
    // Add new info
    if (info) {
        const div = document.createElement('div');
        div.className = 'payment-info';
        div.innerHTML = info;
        this.parentNode.appendChild(div);
    }
});
</script>
@endpush