<style>
    body {
        padding-top: 60px;
    }

    #navbar {
        transition: transform 0.3s ease;
        font-weight: 400;
        color: black;
        height: 60px;
    }

    #navbar.hide {
        transform: translateY(-100%);
    }
</style>

<header>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm text-dark bg-snow-storm1">
        <div class="container-fluid bg-snow-storm1">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapsibleContent" aria-controls="navbarCollapsibleContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapsibleContent">
                <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products') ? 'active' : '' }}"
                            href="{{ route('products') }}">All
                            Products</a>
                    </li>
                </ul>
            </div>

            <!-- Search bar (centered) -->
            <form class="d-flex flex-grow-1 my-auto" role="search" action="{{ route('products') }}" method="GET"
                style="max-width: 40%; height: 38px; margin-right: 20px;">
                <input class="form-control me-2 w-100" type="search" name="keyword" placeholder="Search..." aria-label="Search" />
                <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <!-- Right icons -->
            <div class="d-flex align-items-center" style="margin-right: 20px;">
                <!-- Shopping cart icon -->
                <a class="nav-link me-3" href="{{ route('cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                @auth
                    <!-- Logged-in user dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <!-- Guest dropdown -->
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>