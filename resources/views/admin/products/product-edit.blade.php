@extends('admin.layouts.layout')

@section('title', 'Edit Product')

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
            <li class="breadcrumb-item active" aria-current="page">Edit: {{ $product->product_name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Edit Product</h3>
                </div>
                <div class="card-body">
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Edit Product Form -->
                    <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $product->product_name) }}" 
                                   autocomplete="off" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="{{ $product->category_id }}">{{ $product->category->category_name }} (Current)</option>
                                @foreach($categories as $category)
                                    @if($category->category_id != $product->category_id)
                                        <option value="{{ $category->category_id }}" 
                                                {{ old('category') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $product->price) }}" 
                                   step="0.01" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image Display -->
                        @if($product->product_image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div class="border rounded p-2 bg-light">
                                    <img src="{{ asset('image/products/' . $product->product_image) }}" 
                                         alt="{{ $product->product_name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px; max-height: 200px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="image" class="form-label">Update Product Image</label>
                            <input type="file" name="image" id="image" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*">
                            <div class="form-text">Leave empty to keep current image. Supported formats: JPG, PNG, GIF. Maximum size: 5MB</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Details</label>
                            <textarea name="detail" id="detail" rows="5" 
                                      class="form-control @error('detail') is-invalid @enderror" 
                                      placeholder="Enter product description...">{{ old('detail', $product->detail) }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', $product->stock) }}" 
                                   min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-save"></i> Update Product
                                </button>
                                <a href="{{ route('admin.products.show', $product->product_id) }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Back to Products
                                </a>
                            </div>
                            <div>
                                <!-- Delete Button with Reusable JS -->
                                <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" class="d-inline" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" 
                                            data-delete-modal="true"
                                            data-delete-item="{{ $product->product_name }}"
                                            data-delete-message="Are you sure you want to delete this product?"
                                            data-delete-details="<strong>Product:</strong> {{ $product->product_name }}<br><strong>Category:</strong> {{ $product->category->category_name }}<br><strong>Price:</strong> ${{ number_format($product->price, 2) }}"
                                            data-delete-form="deleteForm">
                                        <i class="fa-solid fa-trash"></i> Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Info Sidebar -->
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Product Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $product->product_id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Current Stock:</strong></td>
                            <td>
                                <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $product->created_at ? $product->created_at->format('d M Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated:</strong></td>
                            <td>{{ $product->updated_at ? $product->updated_at->format('d M Y') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/delete-confirmation.js') }}"></script>
@endpush