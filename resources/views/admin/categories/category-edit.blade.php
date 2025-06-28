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
            <li class="breadcrumb-item">
                <a href="{{ route('admin.categories.show', $category->id) }}" class="no-decoration1 text-muted">
                    {{ $category->name }}
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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="category_name" 
                                   id="category_name" 
                                   class="form-control @error('category_name') is-invalid @enderror"
                                   value="{{ old('category_name', $category->name) }}"
                                   placeholder="Enter category name"
                                   autocomplete="off" 
                                   required>
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-save"></i> Update Category
                                </button>
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Back to Categories
                                </a>
                            </div>
                            <div>
                                {{-- Delete button --}}
                                <form method="post" action="{{ route('admin.categories.destroy', $category->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" 
                                        data-delete-confirm
                                        data-delete-item="{{ $category->name }}"
                                        data-delete-message="Are you sure you want to delete category '{{ $category->name }}'? This action cannot be undone.">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection