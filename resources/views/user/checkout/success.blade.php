@extends('user.layouts.app')

@section('title', 'Checkout Success')

@section('content')
<div class="container-fluid banner-tampilan d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center">Checkout Berhasil!</h1>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h2 class="text-success mb-3">Pesanan Berhasil Dibuat!</h2>
                    <p class="lead">Terima kasih atas pembelian Anda. Pesanan sedang diproses.</p>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Detail Pesanan</h5>
                        <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
                        <p><strong>Tanggal:</strong> {{ $order->tanggal_order->format('d M Y, H:i') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5><i class="fas fa-receipt"></i> Rincian Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Informasi Pembeli:</strong><br>
                            {{ $order->nama_pelanggan }}<br>
                            {{ $order->phone }}<br>
                            {{ $order->alamat_pengiriman }}
                        </div>
                        <div class="col-md-6">
                            <strong>Pembayaran:</strong><br>
                            Metode: {{ ucfirst($order->payment->metode_pembayaran) }}<br>
                            Status: <span class="badge bg-warning">{{ ucfirst($order->payment->status) }}</span><br>
                            Total: <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <hr>

                    <strong>Produk yang Dibeli:</strong>
                    <div class="table-responsive mt-2">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->nama }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-success">
                                    <th colspan="3">Grand Total:</th>
                                    <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Instructions based on payment method -->
            @if($order->payment->metode_pembayaran == 'transfer')
                <div class="card mt-4">
                    <div class="card-header bg-info text-white">
                        <h5><i class="fas fa-credit-card"></i> Instruksi Transfer</h5>
                    </div>
                    <div class="card-body">
                        <p>Silakan transfer ke rekening berikut:</p>
                        <div class="alert alert-light">
                            <strong>Bank BCA</strong><br>
                            No. Rekening: <strong>1234567890</strong><br>
                            Atas Nama: <strong>FP E-commerce</strong><br>
                            Jumlah: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        </div>
                        <p><small class="text-muted">Setelah transfer, pesanan akan diproses dalam 1x24 jam.</small></p>
                    </div>
                </div>
            @elseif($order->payment->metode_pembayaran == 'cod')
                <div class="card mt-4">
                    <div class="card-header bg-warning text-dark">
                        <h5><i class="fas fa-truck"></i> Bayar di Tempat (COD)</h5>
                    </div>
                    <div class="card-body">
                        <p>Pesanan akan dikirim ke alamat Anda. Pembayaran dilakukan saat barang sampai.</p>
                        <p><small class="text-muted">Estimasi pengiriman: 1-3 hari kerja.</small></p>
                    </div>
                </div>
            @elseif($order->payment->metode_pembayaran == 'ewallet')
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fas fa-mobile-alt"></i> E-Wallet</h5>
                    </div>
                    <div class="card-body">
                        <p>Link pembayaran akan dikirim ke WhatsApp Anda dalam beberapa menit.</p>
                        <p><small class="text-muted">Setelah pembayaran berhasil, pesanan akan langsung diproses.</small></p>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary me-2">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
                <a href="{{ route('products') }}" class="btn btn-success">
                    <i class="fas fa-shopping-bag"></i> Belanja Lagi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
