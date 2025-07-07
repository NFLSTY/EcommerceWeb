@extends('user.layouts.layout')

@section('title', $product->name . ' - Product Detail')

@section('content')
    {{-- @include('user.navbar') --}}

    <main class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" />
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="price-text">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <p>{!! nl2br(e($product->detail)) !!}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
            </div>
        </div>

        <hr />

        <h3>Submit Your Review</h3>
        @if(session('error_message'))
            <div class="alert alert-danger">{{ session('error_message') }}</div>
        @endif
        <form method="POST" action="{{ route('product.review.submit', ['product_id' => $product->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div id="star-rating" class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">&#9733;</label>
                </div>
            </div>
            <style>
                .star-rating {
                    direction: rtl;
                    font-size: 1.5rem;
                    unicode-bidi: bidi-override;
                    display: inline-block;
                }
                .star-rating input[type="radio"] {
                    display: none;
                }
                .star-rating label {
                    color: #ddd;
                    cursor: pointer;
                }
                .star-rating input[type="radio"]:checked ~ label,
                .star-rating label:hover,
                .star-rating label:hover ~ label {
                    color: #ffc107;
                }
            </style>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>

        <hr />

        <h3>Reviews</h3>
        @if($reviews->isEmpty())
            <p>No reviews yet. Be the first to review this product!</p>
        @else
            @foreach($reviews as $review)
                <div class="mb-3 border rounded p-3">
                    <strong>{{ $review->user ? $review->user->name : $review->user_name }}</strong>
                    <span class="text-warning">
                        @for ($i = 0; $i < $review->rating; $i++)
                            &#9733;
                        @endfor
                        @for ($i = $review->rating; $i < 5; $i++)
                            &#9734;
                        @endfor
                    </span>
                    <p>{!! nl2br(e($review->comment)) !!}</p>
                    <small class="text-muted">{{ $review->created_at->format('F j, Y, g:i a') }}</small>
                </div>
            @endforeach
        @endif
    </main>

    {{-- @include('user.footer') --}}

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
@endsection