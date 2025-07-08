@extends('user.layouts.layout')

@section('title', 'Order Details')

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
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }
    .order-header {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }
    .back-btn {
        background-color: transparent;
        border: 1px solid #4a90e2;
        color: #4a90e2;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
    }
    .back-btn:hover {
        background-color: #4a90e2;
        color: white;
    }
    .order-info {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 30px;
        margin-bottom: 20px;
    }
    .info-item h3 {
        color: #333;
        margin-bottom: 5px;
        font-size: 18px;
    }
    .info-item p {
        color: #666;
        margin-bottom: 5px;
    }
    .order-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        display: inline-block;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-processing {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    .status-shipped {
        background-color: #d4edda;
        color: #155724;
    }
    .status-delivered {
        background-color: #d4edda;
        color: #155724;
    }
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    .order-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
    .order-items {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .section-title {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        color: #333;
    }
    .item-card {
        display: flex;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    .item-card:last-child {
        border-bottom: none;
    }
    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f5f5f5;
        flex-shrink: 0;
    }
    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .item-details {
        flex: 1;
    }
    .item-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .item-desc {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .item-qty-price {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .item-qty {
        color: #666;
        font-size: 14px;
    }
    .item-price {
        font-weight: 600;
        color: #4a90e2;
        font-size: 16px;
    }
    .order-summary {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f5f5f5;
    }
    .summary-row:last-child {
        border-bottom: 2px solid #4a90e2;
        font-weight: 600;
        font-size: 18px;
        color: #333;
    }
    .summary-label {
        color: #666;
    }
    .summary-value {
        color: #333;
        font-weight: 500;
    }
    .payment-info {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }
    .payment-method {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    .payment-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
    }
    .status-paid {
        background-color: #d4edda;
        color: #155724;
    }
    .status-unpaid {
        background-color: #f8d7da;
        color: #721c24;
    }
    .status-refunded {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    @media (max-width: 992px) {
        .order-content {
            grid-template-columns: 1fr;
        }
        .order-info {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
    @media (max-width: 768px) {
        .container {
            margin: 15px auto;
            padding: 0 15px;
        }
        .order-header, .order-items, .order-summary, .payment-info {
            padding: 20px;
        }
        .item-card {
            flex-direction: column;
            gap: 15px;
        }
        .item-image {
            width: 100%;
            height: 200px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="order-header">
        <a href="{{ route('profile.orders') }}" class="back-btn">← Back to Orders</a>
        
        <div class="order-info">
            <div class="info-item">
                <h3>Order #{{ $order->id }}</h3>
                <p>Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            <div class="info-item">
                <h3>Status</h3>
                <div class="order-status status-{{ strtolower($order->status) }}">
                    {{ ucfirst($order->status) }}
                </div>
            </div>
            <div class="info-item">
                <h3>Total Amount</h3>
                <p style="font-size: 24px; font-weight: 600; color: #4a90e2;">
                    Rp{{ number_format($order->total, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="order-content">
        <div class="order-items">
            <div class="section-title">Order Items</div>
            
            @foreach($order->orderItem as $item)
                <div class="item-card">
                    <div class="item-image">
                        <img src="{{ asset('storage/' . $item->product->image_url) }}" 
                             alt="{{ $item->product->name }}">
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-desc">{{ Str::limit($item->product->description ?? 'No description available', 100) }}</div>
                        <div class="item-qty-price">
                            <div class="item-qty">Quantity: {{ $item->quantity }}</div>
                            <div class="item-price">
                                Rp{{ number_format($item->product->price, 0, ',', '.') }} × {{ $item->quantity }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="order-summary">
            <div class="section-title">Order Summary</div>
            
            @php
                $subtotal = $order->orderItem->sum(function($item) {
                    return $item->product->price * $item->quantity;
                });
                $shipping = 0; // You can calculate shipping cost here
                $tax = 0; // You can calculate tax here
            @endphp

            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Shipping</span>
                <span class="summary-value">Rp{{ number_format($shipping, 0, ',', '.') }}</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Tax</span>
                <span class="summary-value">Rp{{ number_format($tax, 0, ',', '.') }}</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Total</span>
                <span class="summary-value">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    @if($order->payment)
        <div class="payment-info">
            <div class="section-title">Payment Information</div>
            
            <div class="payment-method">
                <strong>Payment Method:</strong>
                <span>{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</span>
            </div>
            
            <div class="payment-method">
                <strong>Payment Status:</strong>
                <span class="payment-status status-{{ strtolower($order->payment->status) }}">
                    {{ ucfirst($order->payment->status) }}
                </span>
            </div>
            
            @if($order->payment->payment_reference)
                <div class="payment-method">
                    <strong>Payment Reference:</strong>
                    <span>{{ $order->payment->payment_reference }}</span>
                </div>
            @endif
            
            <div class="payment-method">
                <strong>Amount Paid:</strong>
                <span>Rp{{ number_format($order->payment->paid_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    @endif
</div>
@endsection
