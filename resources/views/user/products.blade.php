@extends('user.layouts.layout')

@section('title', 'Products')

@section('content')
    <main>
        <div class="container-fluid px-5 py-4">
            <div class="row">
                <!-- Categories -->
                <div class="col-lg-2 mb-5">
                    <h3 class="mb-4">Category</h3>
                    <ul class="list-group">
                        @foreach ($categories as $category)
                            <a class="text-decoration-none" href="{{ route('products', ['category' => $category->name]) }}">
                                <li class="list-group-item">{{ $category->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>

                <!-- Products -->
                <div class="col-lg-10">
                    <h3 class="text-center mb-3">Products</h3>

                    @if (count($products) === 0)
                        <h4 class="text-center my-5">Product not available!</h4>
                    @endif

                    <div class="row row-cols-2 row-cols-md-4">
                        @foreach ($products as $product)
                            <div class="col px-1 py-2 d-flex">
                                <div class="d-flex flex-column w-100 p-0 product-text">
                                    <a href="{{ route('product-details', $product->product_id) }}"
                                        class="text-decoration-none product-text">
                                        <div class="card-template mb-2"
                                            style="--bg-image: url('{{ asset('storage/' . $product->image_url) }}')">
                                        </div>
                                        <h6 id="product-name" class="mb-1">{{ $product->name }}</h6>
                                        <p id="product-price" class="mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </a>
                                    <div class="mt-auto">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="w-100 button-template">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection