<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('categories') ? 'active' : '' }}"
                            href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link text-white {{ request()->is('products') ? 'active' : '' }}"
                            href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <div class="d-flex align-items-center" style="margin-right: 20px;">
                        @auth
                            @can('access-admin')
                                <!-- Logged-in user dropdown -->
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li><a class="dropdown-item" href="{{ route('home') }}">User Homepage</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">My profile</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endcan
                        @endauth
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</header>