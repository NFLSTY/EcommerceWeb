<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('categories') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('products') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">Products</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>