@extends('admin.layouts.layout')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house"></i> Home
            </li>
        </ol>
    </nav>
    <h2>Hello {{ $username }}</h2>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-category p-4">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-solid fa-list fa-7x text-dark"></i>
                        </div>
                        <div class="col-6 text-light">
                            <h3 class="fs-2">Category</h3>
                            <p class="fs-4">{{ $totalCategory }} Category</p>
                            <p><a href="{{ route('category-detail') }}" class="no-decoration">Category Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-product p-4">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa-solid fa-box-open fa-7x text-dark"></i>
                        </div>
                        <div class="col-6 text-light">
                            <h3 class="fs-2">Product</h3>
                            <p class="fs-4">{{ $totalProduct }} Product</p>
                            <p><a href="{{ route('product-detail') }}" class="no-decoration">Product Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
