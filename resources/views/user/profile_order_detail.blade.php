@extends('user.layouts.app')

@section('title', 'Order Details - #' . $order->order_number)

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f4f4f4;
        min-height: 100vh;
    }

    .container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .page-header {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        color: #333;
        font-size: 28px;
        font-weight: 600;
    }

    .back-btn {
        background: linear-gradient(135deg, #6c757d, #545b62);
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #545b62, #3d4145);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
        text-decoration: none;
    }

    .order-summary {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e1e5e9;
    }

    .order-number {
        font-size: 24px;
        font-weight: 600;
        color: #4a90e2;
    }

    .order-date {
        color: #666;
        font-size: 16px;
    }

    .order-status {
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-shipped {
        background-color: #cce5ff;
        color: #004085;
        border: 1px solid #99d6ff;
    }

    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .info-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #4a90e2;
    }

    .info-section h3 {
        color: #333;
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: 600;
    }

    .info-item {
        margin-bottom: 10px;
    }

    .info-label {
        font-weight: 600;
        color: #333;
        display: inline-block;
        width: 120px;
    }

    .info-value {
        color: #666;
    }

    .products-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .products-header {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e1e5e9;
    }

    .products-header h2 {
        color: #333;
        font-size: 22px;
        font-weight: 600;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #e1e5e9;
    }

    .product-table td {
        padding: 15px;
        border-bottom: 1px solid #e1e5e9;
        vertical-align: middle;
    }

    .product-table tr:last-child td {
        border-bottom: none;
    }

    .product-table tr:hover {
        background-color: #f8f9fa;
    }

    .product-name {
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .product-price,
    .product-total {
        font-weight: 600;
        color: #4a90e2;
        font-size: 16px;
    }

    .quantity-badge {
        background-color: #4a90e2;
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: 600;
    }

    .total-section {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
        padding: 25px 30px;
        border-radius: 10px;
        text-align: right;
    }

    .total-section h3 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }

    .total-amount {
        font-size: 32px;
        font-weight: 700;
        margin-top: 10px;
    }

    .payment-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .payment-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e1e5e9;
    }

    .payment-header h2 {
        color: #333;
        font-size: 22px;
        font-weight: 600;
    }

    .payment-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .payment-method {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        border: 2px solid #e1e5e9;
    }

    .payment-method i {
        font-size: 32px;
        color: #4a90e2;
        margin-bottom: 10px;
    }

    .payment-method h4 {
        color: #333;
        margin-bottom: 5px;
    }

    .payment-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-top: 10px;
    }

    .payment-paid {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .payment-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .order-info-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .order-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .product-table {
            font-size: 14px;
        }

        .product-table th,
        .product-table td {
            padding: 10px 8px;
        }

        .payment-info {
            grid-template-columns: 1fr;
        }

        .total-section {
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Order Details</h1>
        <a href="{{ route('profile.orders') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>

    <!-- Order Summary -->
    <div class="order-summary">
        <div class="order-header">
            <div>
                <div class="order-number">#{{ $order->order_number }}</div>
                <div class="order-date">Ordered on {{ $order->created_at->format('F d, Y \a\t H:i') }}</div>
            </div>
            <div class="order-status status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </div>
        </div>

        <div class="order-info-grid">
            <div class="info-section">
                <h3><i class="fas fa-user"></i> Customer Information</h3>
                <div class="info-item">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $order->nama_pelanggan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $order->phone }}</span>
                </div>
            </div>

            <div class="info-section">
                <h3><i class="fas fa-shipping-fast"></i> Shipping Information</h3>
                <div class="info-item">
                    <span class="info-label">Address:</span>
                    <span class="info-value">{{ $order->alamat_pengiriman }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <div class="products-header">
            <h2><i class="fas fa-box"></i> Order Items</h2>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <div class="product-name">{{ $item->product->nama }}</div>
                        </td>
                        <td>
                            <div class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            <span class="quantity-badge">{{ $item->qty }}</span>
                        </td>
                        <td>
                            <div class="product-total">Rp {{ number_format($item->total, 0, ',', '.') }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <h3>Order Total</h3>
            <div class="total-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="payment-section">
        <div class="payment-header">
            <h2><i class="fas fa-credit-card"></i> Payment Information</h2>
        </div>

        <div class="payment-info">
            <div class="payment-method">
                @if($order->payment->metode_pembayaran == 'transfer')
                    <i class="fas fa-university"></i>
                    <h4>Bank Transfer</h4>
                @elseif($order->payment->metode_pembayaran == 'credit_card')
                    <i class="fas fa-credit-card"></i>
                    <h4>Credit Card</h4>
                @elseif($order->payment->metode_pembayaran == 'paypal')
                    <i class="fab fa-paypal"></i>
                    <h4>PayPal</h4>
                @else
                    <i class="fas fa-money-bill-wave"></i>
                    <h4>{{ ucfirst($order->payment->metode_pembayaran) }}</h4>
                @endif
                <div class="payment-status payment-{{ $order->payment->status }}">
                    {{ ucfirst($order->payment->status) }}
                </div>
            </div>

            <div class="info-section">
                <h3>Payment Details</h3>
                <div class="info-item">
                    <span class="info-label">Method:</span>
                    <span class="info-value">{{ ucfirst(str_replace('_', ' ', $order->payment->metode_pembayaran)) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="info-value">{{ ucfirst($order->payment->status) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Amount:</span>
                    <span class="info-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any order-specific functionality here
        console.log('Order detail page loaded for order #{{ $order->order_number }}');
    });
</script>
@endpush
