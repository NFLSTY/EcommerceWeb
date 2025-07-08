@extends('user.layouts.layout')

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
    .profile-header {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
    }
    .profile-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-info h2 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #333;
    }
    .profile-info p {
        color: #666;
        margin-bottom: 10px;
    }
    .breadcrumb {
        color: #666;
        font-size: 14px;
    }
    .breadcrumb a {
        color: #4a90e2;
        text-decoration: none;
    }
    .profile-content {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 30px;
    }
    .profile-sidebar {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }
    .sidebar-menu {
        list-style: none;
    }
    .sidebar-menu li {
        margin-bottom: 10px;
    }
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .sidebar-menu a:hover {
        background-color: #f4f4f4;
    }
    .sidebar-menu a.active {
        background-color: #e6f0ff;
        color: #4a90e2;
        font-weight: 500;
    }
    .orders-main {
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
    .order-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .order-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .order-info {
        display: flex;
        gap: 30px;
    }
    .order-info div {
        font-size: 14px;
    }
    .order-info strong {
        display: block;
        color: #333;
        margin-bottom: 2px;
    }
    .order-info span {
        color: #666;
    }
    .order-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
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
        background-color: #cce7ff;
        color: #004085;
    }
    .status-delivered {
        background-color: #d4edda;
        color: #155724;
    }
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    .order-items {
        padding: 20px;
    }
    .order-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    .order-item:last-child {
        border-bottom: none;
    }
    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        overflow: hidden;
        background-color: #f8f9fa;
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
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }
    .item-price {
        color: #666;
        font-size: 14px;
    }
    .item-quantity {
        color: #666;
        font-size: 14px;
        margin-left: auto;
    }
    .order-actions {
        padding: 15px 20px;
        background-color: #f8f9fa;
        border-top: 1px solid #ddd;
        display: flex;
        gap: 10px;
    }
    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.3s;
    }
    .btn-primary {
        background-color: #4a90e2;
        color: white;
    }
    .btn-primary:hover {
        background-color: #3b7bd4;
    }
    .btn-outline {
        background-color: transparent;
        border: 1px solid #4a90e2;
        color: #4a90e2;
    }
    .btn-outline:hover {
        background-color: #4a90e2;
        color: white;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }
    .empty-state i {
        font-size: 48px;
        margin-bottom: 20px;
        color: #ccc;
    }
    .empty-state h3 {
        margin-bottom: 10px;
        color: #333;
    }
    @media (max-width: 992px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
        .profile-sidebar {
            margin-bottom: 20px;
        }
    }
    @media (max-width: 768px) {
        .order-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
        .order-info {
            flex-direction: column;
            gap: 10px;
        }
        .order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .item-quantity {
            margin-left: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="profile-pic">
            <img src="{{ $user->profile_image_url }}" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            <div class="breadcrumb">
                <a href="{{ route('profile.show') }}">Profile</a> / My Orders
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Personal Information</a></li>
                <li><a href="{{ route('profile.orders') }}" class="active"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                <li><a href="{{ route('profile.show') }}#password-section"><i class="fas fa-lock"></i> Change Password</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </li>
            </ul>
        </div>

        <div class="orders-main">
            <div class="section-title">My Orders</div>

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-info">
                                <div>
                                    <strong>Order #{{ $order->id }}</strong>
                                    <span>{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <strong>Total</strong>
                                    <span>Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="order-status status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </div>
                        </div>

                        <div class="order-items">
                            @foreach($order->orderItem as $item)
                                <div class="order-item">
                                    <div class="item-image">
                                        @if($item->product && $item->product->image_url)
                                            <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}">
                                        @else
                                            <div style="width: 100%; height: 100%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image" style="color: #ccc;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">{{ $item->product->name ?? 'Product not found' }}</div>
                                        <div class="item-price">Rp{{ number_format($item->product->price ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                                </div>
                            @endforeach
                        </div>

                        <div class="order-actions">
                            <a href="{{ route('profile.orders.show', $order->id) }}" class="btn btn-outline">View Details</a>
                            @if($order->status === 'delivered')
                                <a href="#" class="btn btn-primary">Write Review</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-shopping-bag"></i>
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet. Start shopping to see your orders here!</p>
                    <a href="{{ route('products') }}" class="btn btn-primary" style="margin-top: 20px;">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
