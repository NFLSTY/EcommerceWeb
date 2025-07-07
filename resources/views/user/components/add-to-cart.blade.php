{{-- Add to Cart Button Component --}}
{{-- Usage: @include('user.components.add-to-cart', ['product' => $product]) --}}

<form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    
    <div class="row align-items-end">
        <div class="col-md-4 mb-2">
            <label for="qty_{{ $product->id }}" class="form-label">Quantity:</label>
            <input type="number" 
                  id="qty_{{ $product->id }}" 
                  name="qty" 
                  value="1" 
                  min="1" 
                  max="99" 
                  class="form-control">
        </div>
        <div class="col-md-8 mb-2">
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
        </div>
    </div>
</form>

<style>
.add-to-cart-form .btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to add to cart buttons
    document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
        form.addEventListener('submit', function() {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            button.disabled = true;
        });
    });
});
</script>
