@extends('admin.layouts.layout')

@section('title' 'Category')

@section('content')
    <main>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}" class="no-decoration1 text-muted">
                            <i class="fa-solid fa-house"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>

            <div class="my-4 col-12 col-md-6">
                <h3>Add category</h3>

                @if(session('success'))
                    <div class="p-3 mb-2 bg-info text-white">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="category">Category</label>
                        <input type="text" name="category" id="category" placeholder="Input category name"
                            class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive mt-5">
                <h3>Category List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Category data not available</td>
                            </tr>
                        @else
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.detail', ['cat' => $category->id]) }}" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection