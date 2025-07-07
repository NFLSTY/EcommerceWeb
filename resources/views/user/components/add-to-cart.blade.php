{{-- Add to Cart Button Component --}}
{{-- Usage: @include('user.components.add-to-cart', ['product' => $product]) --}}
{{--
    Optional Parameters:
    - $showQty (boolean, default: true): Set to false to hide the quantity input.
    - $buttonClass (string, default: 'btn btn-primary btn-lg w-100'): Custom CSS classes for the button.
    - $buttonText (string, default: '<i class="fas fa-shopping-cart"></i> Add to Cart'): Custom text/HTML for the button.
--}}

@php
    // Set default values for the optional parameters if they aren't passed
    $showQty = $showQty ?? true;
    $buttonClass = $buttonClass ?? 'btn btn-primary btn-lg w-100';
    $buttonText = $buttonText ?? '<i class="fas fa-shopping-cart"></i> Add to Cart';
@endphp

<form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    @if ($showQty)
        {{-- This layout is for pages where the quantity input is visible (e.g., product details) --}}
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
                <button type="submit" class="{{ $buttonClass }}">
                    {!! $buttonText !!}
                </button>
            </div>
        </div>
    @else
        {{-- This layout is for pages where the quantity input is hidden (e.g., product cards) --}}
        <input type="hidden" name="qty" value="1"> {{-- Always add 1 item if qty is hidden --}}
        <button type="submit" class="{{ $buttonClass }}">
            {!! $buttonText !!}
        </button>
    @endif
</form>

<style>
.add-to-cart-form .btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
</style>

<script>
// This script will only be included once on the page, even if the component is used many times.
if (typeof addCartFormListener === 'undefined') {
    const addCartFormListener = true;
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
            form.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                button.disabled = true;
            });
        });
    });
}
</script>
