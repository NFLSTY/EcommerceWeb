@extends('user.layouts.app')

@section('title', 'Profile Testing Dashboard')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 40px;
        color: white;
    }

    .dashboard-header h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .dashboard-header p {
        font-size: 18px;
        opacity: 0.9;
    }

    .testing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .test-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .test-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #4a90e2, #7b68ee);
    }

    .test-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    }

    .test-card-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .test-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 24px;
        color: white;
    }

    .icon-profile { background: linear-gradient(135deg, #4a90e2, #357abd); }
    .icon-orders { background: linear-gradient(135deg, #28a745, #20c997); }
    .icon-wishlist { background: linear-gradient(135deg, #e91e63, #c2185b); }
    .icon-notifications { background: linear-gradient(135deg, #17a2b8, #138496); }
    .icon-edit { background: linear-gradient(135deg, #fd7e14, #e55a2b); }

    .test-card-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .test-card-subtitle {
        color: #666;
        font-size: 14px;
    }

    .test-card-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .test-features {
        margin-bottom: 25px;
    }

    .test-features h4 {
        color: #333;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
    }

    .feature-list li {
        padding: 5px 0;
        color: #666;
        display: flex;
        align-items: center;
    }

    .feature-list li::before {
        content: '✓';
        color: #28a745;
        font-weight: bold;
        margin-right: 8px;
        font-size: 14px;
    }

    .test-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #357abd, #2968a3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
        text-decoration: none;
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d, #545b62);
        color: white;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #545b62, #3d4145);
        transform: translateY(-2px);
        text-decoration: none;
        color: white;
    }

    .stats-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .stats-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .stats-header h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #4a90e2;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #4a90e2;
        display: block;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .info-section {
        background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border-left: 5px solid #4a90e2;
    }

    .info-section h3 {
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-section p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .info-section ul {
        color: #666;
        margin-left: 20px;
    }

    .info-section li {
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        .testing-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .test-card {
            padding: 20px;
        }
        
        .dashboard-header h1 {
            font-size: 28px;
        }
        
        .test-buttons {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="dashboard-header">
        <h1><i class="fas fa-user-circle"></i> User Profile Testing Dashboard</h1>
        <p>Test all profile features with comprehensive dummy data</p>
    </div>

    <div class="info-section">
        <h3><i class="fas fa-info-circle"></i> Testing Information</h3>
        <p>This dashboard provides comprehensive testing for all user profile features with realistic dummy data. Each section includes various scenarios and edge cases.</p>
        <ul>
            <li><strong>User Data:</strong> Sarah Michelle Johnson - Marketing Manager with 2+ years membership</li>
            <li><strong>Orders:</strong> 5 orders with different statuses (delivered, shipped, processing, cancelled)</li>
            <li><strong>Wishlist:</strong> 8 items across different categories and price ranges</li>
            <li><strong>Notifications:</strong> Comprehensive settings for email, SMS, and push notifications</li>
        </ul>
    </div>

    <div class="stats-section">
        <div class="stats-header">
            <h2>Profile Overview Stats</h2>
            <p>Quick overview of the dummy user profile data</p>
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">23</span>
                <span class="stat-label">Total Orders</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">8</span>
                <span class="stat-label">Wishlist Items</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">45.7M</span>
                <span class="stat-label">Total Spent (IDR)</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">2,875</span>
                <span class="stat-label">Loyalty Points</span>
            </div>
        </div>
    </div>

    <div class="testing-grid">
        <!-- Profile Overview Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon icon-profile">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <div class="test-card-title">Profile Overview</div>
                    <div class="test-card-subtitle">Main profile display</div>
                </div>
            </div>
            <div class="test-card-description">
                View and manage personal information with comprehensive user data including profile image, contact details, and account statistics.
            </div>
            <div class="test-features">
                <h4>Features to Test:</h4>
                <ul class="feature-list">
                    <li>Profile image upload with dynamic avatar</li>
                    <li>Personal information display</li>
                    <li>Password change functionality</li>
                    <li>Account security section</li>
                    <li>Navigation to other profile sections</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('profile.test') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View Profile
                </a>
                <a href="{{ route('profile.edit.test') }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon icon-orders">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div>
                    <div class="test-card-title">Order Management</div>
                    <div class="test-card-subtitle">Order history & details</div>
                </div>
            </div>
            <div class="test-card-description">
                Comprehensive order management with 5 sample orders showing different statuses, payment methods, and shipping information.
            </div>
            <div class="test-features">
                <h4>Features to Test:</h4>
                <ul class="feature-list">
                    <li>Order listing with status badges</li>
                    <li>Detailed order information</li>
                    <li>Payment and shipping details</li>
                    <li>Order tracking numbers</li>
                    <li>Product information within orders</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('profile.orders.test') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i> View Orders
                </a>
                <a href="{{ route('profile.orders.detail.test', 'ORD-2024-001234') }}" class="btn btn-secondary">
                    <i class="fas fa-receipt"></i> Sample Order
                </a>
            </div>
        </div>

        <!-- Wishlist Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon icon-wishlist">
                    <i class="fas fa-heart"></i>
                </div>
                <div>
                    <div class="test-card-title">Wishlist</div>
                    <div class="test-card-subtitle">Saved products</div>
                </div>
            </div>
            <div class="test-card-description">
                Product wishlist with 8 diverse items across different categories, prices, and availability statuses.
            </div>
            <div class="test-features">
                <h4>Features to Test:</h4>
                <ul class="feature-list">
                    <li>Product grid layout with images</li>
                    <li>Add to cart functionality</li>
                    <li>Remove from wishlist</li>
                    <li>Product availability status</li>
                    <li>Price and rating display</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('profile.wishlist.test') }}" class="btn btn-primary">
                    <i class="fas fa-heart"></i> View Wishlist
                </a>
            </div>
        </div>

        <!-- Notifications Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon icon-notifications">
                    <i class="fas fa-bell"></i>
                </div>
                <div>
                    <div class="test-card-title">Notification Settings</div>
                    <div class="test-card-subtitle">Communication preferences</div>
                </div>
            </div>
            <div class="test-card-description">
                Comprehensive notification management with email, SMS, and push notification settings across multiple categories.
            </div>
            <div class="test-features">
                <h4>Features to Test:</h4>
                <ul class="feature-list">
                    <li>Toggle switches for different notification types</li>
                    <li>Email frequency settings</li>
                    <li>Security notification preferences</li>
                    <li>Privacy and data settings</li>
                    <li>Communication language options</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('profile.notifications.test') }}" class="btn btn-primary">
                    <i class="fas fa-cog"></i> Manage Settings
                </a>
            </div>
        </div>

        <!-- Profile Edit Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon icon-edit">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <div class="test-card-title">Profile Editing</div>
                    <div class="test-card-subtitle">Update personal information</div>
                </div>
            </div>
            <div class="test-card-description">
                Comprehensive profile editing form with validation, image upload, and password change functionality.
            </div>
            <div class="test-features">
                <h4>Features to Test:</h4>
                <ul class="feature-list">
                    <li>Form validation and error handling</li>
                    <li>Real-time image preview</li>
                    <li>Password strength validation</li>
                    <li>Responsive form layout</li>
                    <li>Success/error feedback</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('profile.edit.test') }}" class="btn btn-primary">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>
        </div>

        <!-- Test Scenarios Card -->
        <div class="test-card">
            <div class="test-card-header">
                <div class="test-card-icon" style="background: linear-gradient(135deg, #9c27b0, #673ab7);">
                    <i class="fas fa-flask"></i>
                </div>
                <div>
                    <div class="test-card-title">Test Scenarios</div>
                    <div class="test-card-subtitle">Edge cases & variations</div>
                </div>
            </div>
            <div class="test-card-description">
                Various test scenarios to check different UI states and edge cases with different data combinations.
            </div>
            <div class="test-features">
                <h4>Available Scenarios:</h4>
                <ul class="feature-list">
                    <li>Different order statuses and types</li>
                    <li>Various product availability states</li>
                    <li>Multiple notification configurations</li>
                    <li>Image upload success/failure states</li>
                    <li>Form validation scenarios</li>
                </ul>
            </div>
            <div class="test-buttons">
                <a href="{{ route('testing') }}" class="btn btn-primary">
                    <i class="fas fa-vial"></i> Main Testing
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add some interactive elements
        const cards = document.querySelectorAll('.test-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        console.log('Profile Testing Dashboard loaded successfully');
        console.log('Available test routes:', {
            'Profile': '{{ route("profile.test") }}',
            'Edit': '{{ route("profile.edit.test") }}',
            'Orders': '{{ route("profile.orders.test") }}',
            'Wishlist': '{{ route("profile.wishlist.test") }}',
            'Notifications': '{{ route("profile.notifications.test") }}'
        });
    });
</script>
@endpush
