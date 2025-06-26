@extends('admin.layouts.layout')

@section('title', 'Products')

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
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <!-- Header with Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Product List</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category->category_name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->product_id) }}"
                            class="btn btn-info btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="{{ route('admin.products.product-edit', $product->product_id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                            method="POST" class="d-inline" id="deleteForm{{ $product->product_id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                data-delete-confirm="true"
                                data-delete-item="{{ $product->product_name }}"
                                data-delete-form="deleteForm{{ $product->product_id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No products available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination if needed -->
    @if(method_exists($products, 'links'))
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/delete-confirmation.js') }}"></script>
@endpush