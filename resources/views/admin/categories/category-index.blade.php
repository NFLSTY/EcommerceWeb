@extends('admin.layouts.layout')

@section('title', 'Categories')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="no-decoration1 text-muted">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>

    {{-- Add Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Category List</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Category
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Categories Table --}}
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Category Name</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->product->count() > 0)
                            <span class="badge bg-warning text-dark">
                                {{ $category->product->count() }} product{{ $category->product->count() > 1 ? 's' : '' }}
                            </span>
                        @else
                            <span class="badge bg-success">Empty</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" 
                           class="btn btn-sm btn-info me-1"
                           title="View Details">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                           class="btn btn-sm btn-warning me-1"
                           title="Edit Category">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        
                        @if($category->product->count() > 0)
                            {{-- Disabled delete button for categories with products --}}
                            <button type="button" class="btn btn-sm btn-secondary" 
                                disabled
                                title="Cannot delete: This category is being used by {{ $category->product->count() }} product(s)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        @else
                            {{-- Active delete button for empty categories --}}
                            <form class="d-inline" method="post" action="{{ route('admin.categories.destroy', $category->id) }}" id="deleteForm{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn" 
                                    data-category-name="{{ $category->name }}"
                                    data-form-id="deleteForm{{ $category->id }}"
                                    title="Delete Category">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <div class="text-muted">
                            <i class="fa-solid fa-folder-open fa-3x mb-3"></i>
                            <p>No categories found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Info Alert --}}
    @php
        $usedCategories = $categories->filter(function($category) {
            return $category->product->count() > 0;
        });
    @endphp
    
    @if($usedCategories->count() > 0)
        <div class="alert alert-info">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-info-circle me-2"></i>
                <div>
                    <strong>Notice:</strong> 
                    {{ $usedCategories->count() }} categor{{ $usedCategories->count() > 1 ? 'ies are' : 'y is' }} currently being used by products and cannot be deleted.
                    <br>
                    <small class="text-muted">
                        To delete a category, remove or reassign all products from that category.
                    </small>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection