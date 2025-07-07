@extends('user.layouts.app')

@section('title', 'Testing Page')

@section('content')
<div class="container-fluid banner-tampilan d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center">🧪 Testing Page</h1>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <h5><i class="fas fa-exclamation-triangle"></i> Development Testing Only</h5>
                <p>Halaman ini hanya untuk testing UI. Hapus sebelum production!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Cart Testing -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-shopping-cart"></i> Cart Testing</h5>
                </div>
                <div class="card-body">
                    <p>Test tampilan keranjang belanja dengan data dummy.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('cart.test') }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye"></i> Lihat Cart dengan Dummy Data
                        </a>
                        
                        <a href="{{ route('cart.dummy') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus"></i> Tambah Dummy Data ke Session
                        </a>
                        
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-shopping-cart"></i> Lihat Cart Asli
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Testing -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-credit-card"></i> Checkout Testing</h5>
                </div>
                <div class="card-body">
                    <p>Test tampilan checkout dan success page dengan data dummy.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('checkout.test') }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye"></i> Lihat Checkout dengan Dummy Data
                        </a>
                        
                        <a href="{{ route('checkout.test-success') }}" class="btn btn-outline-success">
                            <i class="fas fa-check-circle"></i> Lihat Success Page
                        </a>
                        
                        <a href="{{ route('checkout') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-credit-card"></i> Checkout Asli
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Testing -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5><i class="fas fa-user-circle"></i> Profile Testing</h5>
                </div>
                <div class="card-body">
                    <p>Test tampilan profil user dengan data dummy lengkap termasuk orders, wishlist, dan notifications.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.testing') }}" class="btn btn-outline-info">
                            <i class="fas fa-tachometer-alt"></i> Profile Testing Dashboard
                        </a>
                        
                        <a href="{{ route('profile.test') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                        
                        <a href="{{ route('profile.orders.test') }}" class="btn btn-outline-success">
                            <i class="fas fa-shopping-bag"></i> View Orders
                        </a>
                        
                        <a href="{{ route('profile.wishlist.test') }}" class="btn btn-outline-danger">
                            <i class="fas fa-heart"></i> View Wishlist
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Data Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle"></i> Sample Data yang Digunakan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>🖥️ Laptop Gaming ASUS ROG Strix</td>
                                    <td>Rp 15.000.000</td>
                                    <td>1</td>
                                    <td>Rp 15.000.000</td>
                                </tr>
                                <tr>
                                    <td>🖱️ Mouse Gaming Logitech G502</td>
                                    <td>Rp 500.000</td>
                                    <td>2</td>
                                    <td>Rp 1.000.000</td>
                                </tr>
                                <tr>
                                    <td>⌨️ Keyboard Mechanical RGB</td>
                                    <td>Rp 750.000</td>
                                    <td>1</td>
                                    <td>Rp 750.000</td>
                                </tr>
                                <tr>
                                    <td>🖥️ Monitor 4K Samsung 27"</td>
                                    <td>Rp 3.500.000</td>
                                    <td>1</td>
                                    <td>Rp 3.500.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="table-success">
                                    <th colspan="3">Grand Total:</th>
                                    <th>Rp 20.750.000</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Home -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Add some testing functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('🧪 Testing page loaded');
    console.log('Available test routes:');
    console.log('- /cart/test - Cart dengan dummy data');
    console.log('- /checkout/test - Checkout dengan dummy data');
    console.log('- /checkout/test-success - Success page');
    console.log('- /cart/add-dummy - Tambah dummy ke session');
});
</script>
@endpush
