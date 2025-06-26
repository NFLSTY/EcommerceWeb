@extends('admin.layouts.layout')

@section('title', 'Product Details')

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="no-decoration1 text-muted">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.products.index') }}" class="no-decoration1 text-muted">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Product Details</h3>
                    <div>
                        <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-warning">
                            <i class="fa-solid fa-edit"></i> Edit Product
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($product->product_image)
                            <img src="{{ asset('image/products/' . $product->product_image) }}"
                                alt="{{ $product->product_name }}"
                                class="img-fluid rounded shadow">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                style="height: 300px;">
                                <i class="fa-solid fa-image fa-3x text-muted"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Product ID:</th>
                                    <td>{{ $product->product_id }}</td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>
                                        <span class="badge bg-primary">{{ $product->category->category_name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td>
                                        <span class="h5 text-success">${{ number_format($product->price, 2) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Stock:</th>
                                    <td>
                                        <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $product->stock }} units
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $product->created_at ? $product->created_at->format('d M Y, H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $product->updated_at ? $product->updated_at->format('d M Y, H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($product->detail)
                    <div class="mt-4">
                        <h5>Product Description</h5>
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($product->detail)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection