@extends('admin.layouts.layout')

@section('title', 'Add Product')

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
                <a href="{{ route('admin.products.product-index') }}" class="no-decoration1 text-muted">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Add New Product</h3>
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

                    <!-- Add Product Form -->
                    <form action="{{ route('admin.products.product-add') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" autocomplete="off" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ old('category') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}" step="0.01" min="0" required>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                                accept="image/*">
                            <div class="form-text">Supported formats: JPG, PNG, GIF. Maximum size: 5MB</div>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Details</label>
                            <textarea name="detail" id="detail" rows="5"
                                class="form-control @error('detail') is-invalid @enderror"
                                placeholder="Enter product description...">{{ old('detail') }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock') }}" min="0" required>
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Add Product
                            </button>
                            <a href="{{ route('admin.products.product-index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Back to Products
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection