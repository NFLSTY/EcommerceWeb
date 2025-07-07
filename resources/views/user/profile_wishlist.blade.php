@extends('user.layouts.app')

@section('title', 'My Wishlist')

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

    .wishlist-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .wishlist-header {
        background: linear-gradient(135deg, #e91e63, #c2185b);
        color: white;
        padding: 25px 30px;
    }

    .wishlist-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .wishlist-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .wishlist-body {
        padding: 0;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 30px;
    }

    .wishlist-item {
        background-color: white;
        border: 1px solid #e1e5e9;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .wishlist-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100%;
        height: 200px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-image .placeholder {
        color: #ccc;
        font-size: 48px;
    }

    .remove-wishlist {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .wishlist-item:hover .remove-wishlist {
        opacity: 1;
    }

    .remove-wishlist:hover {
        background-color: #dc3545;
        transform: scale(1.1);
    }

    .product-details {
        padding: 20px;
    }

    .product-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .product-description {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .product-price {
        font-size: 20px;
        font-weight: 700;
        color: #e91e63;
        margin-bottom: 15px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        flex: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #357abd, #2968a3);
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(74, 144, 226, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-outline {
        background-color: transparent;
        color: #e91e63;
        border: 2px solid #e91e63;
    }

    .btn-outline:hover {
        background-color: #e91e63;
        color: white;
        text-decoration: none;
    }

    .added-date {
        color: #999;
        font-size: 12px;
        margin-top: 10px;
        text-align: center;
    }

    .empty-wishlist {
        text-align: center;
        padding: 60px 30px;
        color: #666;
    }

    .empty-wishlist i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-wishlist h3 {
        margin-bottom: 10px;
        color: #333;
    }

    .empty-wishlist p {
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

    .wishlist-stats {
        background-color: #f8f9fa;
        padding: 20px 30px;
        border-bottom: 1px solid #e1e5e9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stats-item {
        text-align: center;
    }

    .stats-number {
        font-size: 24px;
        font-weight: 700;
        color: #e91e63;
        display: block;
    }

    .stats-label {
        font-size: 14px;
        color: #666;
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

        .wishlist-grid {
            grid-template-columns: 1fr;
            padding: 20px 15px;
        }

        .wishlist-header {
            padding: 20px 15px;
        }

        .wishlist-stats {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .product-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>My Wishlist</h1>
        <a href="{{ route('profile.show') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="wishlist-container">
        <div class="wishlist-header">
            <h2><i class="fas fa-heart"></i> My Wishlist</h2>
            <p>Save your favorite products for later</p>
        </div>

        @if($wishlistItems->count() > 0)
            <div class="wishlist-stats">
                <div class="stats-item">
                    <span class="stats-number">{{ $wishlistItems->count() }}</span>
                    <span class="stats-label">Items</span>
                </div>
                <div class="stats-item">
                    <span class="stats-number">Rp {{ number_format($wishlistItems->sum(function($item) { return $item->product->harga; }), 0, ',', '.') }}</span>
                    <span class="stats-label">Total Value</span>
                </div>
            </div>

            <div class="wishlist-body">
                <div class="wishlist-grid">
                    @foreach($wishlistItems as $item)
                        <div class="wishlist-item" data-wishlist-id="{{ $item->id }}">
                            <div class="product-image">
                                @if($item->product->gambar && file_exists(public_path('image/' . $item->product->gambar)))
                                    <img src="{{ asset('image/' . $item->product->gambar) }}" alt="{{ $item->product->nama }}">
                                @else
                                    <i class="fas fa-image placeholder"></i>
                                @endif
                                <button class="remove-wishlist" onclick="removeFromWishlist({{ $item->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="product-details">
                                <h3 class="product-name">{{ $item->product->nama }}</h3>
                                <p class="product-description">{{ Str::limit($item->product->deskripsi, 80) }}</p>
                                <div class="product-price">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</div>

                                <div class="product-actions">
                                    <button class="btn btn-primary" onclick="addToCart({{ $item->product->id }})">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <a href="{{ route('product.details', $item->product->id) }}" class="btn btn-outline">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>

                                <div class="added-date">
                                    Added {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="empty-wishlist">
                <i class="fas fa-heart-broken"></i>
                <h3>Your Wishlist is Empty</h3>
                <p>Start browsing and add products you love to your wishlist!</p>
                <a href="{{ route('products') }}" class="shop-now-btn">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function removeFromWishlist(wishlistId) {
        if (confirm('Are you sure you want to remove this item from your wishlist?')) {
            // For testing purposes, just remove the element from the DOM
            // In production, you would make an AJAX call to remove from database
            const wishlistItem = document.querySelector(`[data-wishlist-id="${wishlistId}"]`);
            if (wishlistItem) {
                wishlistItem.style.opacity = '0.5';
                wishlistItem.style.transform = 'scale(0.8)';
                
                setTimeout(() => {
                    wishlistItem.remove();
                    
                    // Check if wishlist is now empty
                    const remainingItems = document.querySelectorAll('.wishlist-item');
                    if (remainingItems.length === 0) {
                        location.reload(); // Reload to show empty state
                    } else {
                        // Update stats
                        updateWishlistStats();
                    }
                }, 300);
            }
            
            // Show success message
            showToast('Item removed from wishlist!', 'success');
        }
    }

    function addToCart(productId) {
        // For testing purposes, just show a message
        // In production, you would make an AJAX call to add to cart
        showToast('Item added to cart!', 'success');
        
        // Optional: Remove from wishlist after adding to cart
        // You can implement this based on your requirements
    }

    function updateWishlistStats() {
        const remainingItems = document.querySelectorAll('.wishlist-item');
        const statsNumber = document.querySelector('.stats-number');
        if (statsNumber) {
            statsNumber.textContent = remainingItems.length;
        }
    }

    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: ${type === 'success' ? '#28a745' : '#4a90e2'};
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-weight: 500;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log('Wishlist page loaded');
    });
</script>
@endpush
