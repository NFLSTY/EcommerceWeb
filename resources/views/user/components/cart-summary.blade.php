{{-- Cart Summary Component for Navbar --}}
{{-- Usage: @include('user.components.cart-summary') --}}

<div class="cart-summary">
    <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            0
        </span>
    </a>
</div>

<script>
// Update cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});

function updateCartCount() {
    fetch('{{ route("cart.count") }}')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.querySelector('.cart-count');
            if (cartBadge) {
                cartBadge.textContent = data.count;
                if (data.count > 0) {
                    cartBadge.style.display = 'inline-block';
                } else {
                    cartBadge.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.log('Error fetching cart count:', error);
        });
}

// Listen for cart updates from other parts of the app
window.addEventListener('cartUpdated', function() {
    updateCartCount();
});
</script>

<style>
.cart-summary .cart-count {
    font-size: 0.75rem;
    min-width: 1.5rem;
    height: 1.5rem;
    display: none;
}
</style>
