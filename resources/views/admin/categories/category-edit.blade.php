@extends('admin.layouts.layout')

@section('title', 'Edit Category')

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
            <li class="breadcrumb-item active" aria-current="page">Edit: {{ $category->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Edit Category</h3>
                </div>
                <div class="card-body">
                    {{-- Error Messages  --}}
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Success Messages  --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    {{-- Edit Category Form --}}
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="Enter category name"
                                   autocomplete="off" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Current Image Display --}}
                        @if($category->category_image)
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <div class="border rounded p-2 bg-light">
                                <img src="{{ asset('storage/' . $category->image_url) }}"
                                    alt="{{ $category->name }}"
                                    class="img-thumbnail"
                                    style="max-width: 300px; max-height: 200px;">
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="image" class="form-label">Update Category Image</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*">
                            <div class="form-text">Leave empty to keep current image. Supported formats: JPG, PNG, GIF. Maximum size: 5MB</div>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-between">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Back to Categories
                            </a>
                            <button type="submit" class="btn btn-primary update-btn">
                                <i class="fa-solid fa-save"></i> Update Category
                            </button>
                            {{-- <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-secondary">
                                <i class="fa-solid fa-eye"></i> View Details
                            </a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Category Info Sidebar --}}
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated:</strong></td>
                            <td>{{ $category->updated_at ? $category->updated_at->format('d M Y') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection