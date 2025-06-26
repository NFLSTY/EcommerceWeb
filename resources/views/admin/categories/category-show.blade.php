@extends('admin.layouts.layout')

@section('title', 'Category Details')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="no-decoration1 text-muted">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.categories.index') }}" class="no-decoration1 text-muted">
                    Categories
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->category_name }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Category Details</h3>
        <div>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Category Name:</strong></td>
                            <td>{{ $category->category_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $category->created_at ? $category->created_at->format('M d, Y H:i') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated:</strong></td>
                            <td>{{ $category->updated_at ? $category->updated_at->format('M d, Y H:i') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Products using this category -->
    @if(isset($products) && $products->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Products in this Category ({{ $products->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection