@extends('user.layouts.app')

@section('title', 'My Orders')

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

    .orders-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .orders-header {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
        padding: 25px 30px;
    }

    .orders-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .orders-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .orders-body {
        padding: 0;
    }

    .order-item {
        border-bottom: 1px solid #e1e5e9;
        padding: 25px 30px;
        transition: background-color 0.3s ease;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item:hover {
        background-color: #f8f9fa;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-number {
        font-size: 18px;
        font-weight: 600;
        color: #4a90e2;
    }

    .order-date {
        color: #666;
        font-size: 14px;
    }

    .order-details {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 20px;
        align-items: center;
    }

    .order-products {
        color: #333;
    }

    .order-products strong {
        display: block;
        margin-bottom: 5px;
    }

    .product-list {
        color: #666;
        font-size: 14px;
        line-height: 1.4;
    }

    .order-total {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .order-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
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

    .view-order-btn {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .view-order-btn:hover {
        background: linear-gradient(135deg, #357abd, #2968a3);
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(74, 144, 226, 0.3);
    }

    .empty-orders {
        text-align: center;
        padding: 60px 30px;
        color: #666;
    }

    .empty-orders i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-orders h3 {
        margin-bottom: 10px;
        color: #333;
    }

    .empty-orders p {
        margin-bottom: 25px;
    }

    .shop-now-btn {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 4px;
        font-weight: 500;
        font-size: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 120px;
        height: 32px;
    }

    .shop-now-btn:hover {
        background: linear-gradient(135deg, #20c997, #17a2b8);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .pagination-wrapper {
        padding: 30px;
        text-align: center;
        border-top: 1px solid #e1e5e9;
    }

    .pagination {
        display: inline-flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 5px;
    }

    .pagination li {
        margin: 0;
    }

    .pagination a,
    .pagination span {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        border: 1px solid #ddd;
        color: #4a90e2;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background-color: #4a90e2;
        color: white;
        border-color: #4a90e2;
    }

    .pagination .active span {
        background-color: #4a90e2;
        color: white;
        border-color: #4a90e2;
    }

    .pagination .disabled span {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
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

        .order-details {
            grid-template-columns: 1fr;
            gap: 15px;
            text-align: center;
        }

        .order-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .orders-header,
        .order-item {
            padding: 20px 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>My Orders</h1>
        <a href="{{ route('profile.show') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="orders-container">
        <div class="orders-header">
            <h2>Order History</h2>
            <p>Track and manage your orders</p>
        </div>

        <div class="orders-body">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-item">
                        <div class="order-header">
                            <div class="order-number">#{{ $order->order_number }}</div>
                            <div class="order-date">{{ $order->created_at->format('M d, Y - H:i') }}</div>
                        </div>

                        <div class="order-details">
                            <div class="order-products">
                                <strong>Products:</strong>
                                <div class="product-list">
                                    @foreach($order->orderItems as $index => $item)
                                        {{ $item->product->nama }}@if($index < count($order->orderItems) - 1), @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="order-total">
                                <strong>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                            </div>

                            <div class="order-status">
                                <span class="status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </div>

                            <div>
                                <a href="{{ route('profile.orders.detail', $order->order_number) }}" class="view-order-btn">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($orders->hasPages())
                    <div class="pagination-wrapper">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <div class="empty-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet. Start shopping to see your order history here.</p>
                    <a href="{{ route('products') }}" class="shop-now-btn">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: Add order filtering or search functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Add any interactive features here
        console.log('Orders page loaded');
    });
</script>
@endpush
