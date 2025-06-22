<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('category') ? 'active' : '' }}" href="{{ route('category') }}">Category</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>